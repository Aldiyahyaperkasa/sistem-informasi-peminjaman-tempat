<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Model_Peminjaman;
use App\Models\Model_Tempat;

class Admin_Data_Peminjaman extends BaseController
{
    protected $peminjamanModel;
    protected $tempatModel;

    public function __construct()
    {
        $this->peminjamanModel = new Model_Peminjaman();
        $this->tempatModel = new Model_Tempat();
    }

    public function index()
    {
        // Ambil semua permintaan pinjaman dari database tabel peminjaman
        $loanRequests = $this->peminjamanModel->findAll();

        // Ambil nama tempat untuk setiap permintaan pinjaman
        foreach ($loanRequests as &$request) {
            $place = $this->tempatModel->find($request['ruangan_dipinjam']);
            $request['nama_ruangan'] = $place['nama_ruangan'];
        }

        // Siapkan array data untuk dikirim ke view
        $data = [
            'peminjaman' => $loanRequests,
            'pager' => $this->peminjamanModel->pager
        ];

        return view('admin/view_admin_data_peminjaman', $data);
    }

    public function acc($id)
    {
        // Update status pinjaman menjadi "disetujui"
        $this->peminjamanModel->update($id, ['status_pinjam' => 'disetujui']);

        // Dapatkan permintaan pinjaman untuk menemukan ID ruangan dipinjam
        $request = $this->peminjamanModel->find($id);
        $roomId = $request['ruangan_dipinjam'];

        // Update roomid (status) menjadi "sedang dipinjamkan"
        $this->tempatModel->updateStatus($roomId, 'sedang dipinjam');

        return redirect()->to('/admin_data_peminjaman')->with('sukses', 'Peminjaman Disetujui!');
    }


    public function tolak($id)
    {
        // pengiriman formulir
        if ($this->request->getMethod() === 'post') {
            // Validasi inputan
            $validationRules = [
                'alasan_penolakan' => 'required'
            ];
            $validationMessages = [
                'alasan_penolakan.required' => 'Masukkan alasan penolakan terlebih dahulu.'
            ];

            if (!$this->validate($validationRules, $validationMessages)) {
                return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
            }

            //Update status permintaan pinjaman menjadi "ditolak" dan simpan alasan penolakannya
            $alasan_penolakan = $this->request->getPost('alasan_penolakan');
            $this->peminjamanModel->update($id, [
                'status_pinjam' => 'ditolak',
                'alasan_penolakan' => $alasan_penolakan
            ]);

            return redirect()->to('/admin_data_peminjaman')->with('error', 'Peminjaman Ditolak!');
        }

        return redirect()->back();
    }


    public function selesai($id)
    {
        // Update status permintaan pinjaman menjadi "selesai"
        $this->peminjamanModel->update($id, ['status_pinjam' => 'selesai']);
        
        // Dapatkan permintaan pinjaman untuk menemukan ID ruangan dipinjam
        $request = $this->peminjamanModel->find($id);
        $roomId = $request['ruangan_dipinjam'];

        // Update status ruangan menjadi "tersedia"
        $this->tempatModel->updateStatus($roomId, 'tersedia');

        return redirect()->to('/admin_data_peminjaman')->with('sukses', 'Peminjaman Selesai!');
    }

}

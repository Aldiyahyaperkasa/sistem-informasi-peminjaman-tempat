<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Model_Peminjaman;
use App\Models\Model_Tempat;

class Pengguna_data_peminjaman extends BaseController
{
    protected $currentUser;

    public function __construct()
    {
        $this->peminjaman = new Model_Peminjaman();
        $this->tempat = new Model_Tempat();
        $this->currentUser = session()->get('fullname'); // mengambil nama lengkap (fullname) saat ini dari sesi yang login
    }

    public function index()
    {
        // Mengambil data peminjaman untuk pengguna saat ini
        $peminjaman = $this->peminjaman->where('peminjam', $this->currentUser)->orderBy('id_peminjaman', 'DESC')->findAll();

        // Memperbaiki data peminjaman dengan mengganti ID ruangan dengan nama ruangan
        foreach ($peminjaman as &$p) {
            $tempat = $this->tempat->find($p['ruangan_dipinjam']);
            if ($tempat) {
                $p['ruangan_dipinjam'] = $tempat['nama_ruangan'];
            } else {
                $p['ruangan_dipinjam'] = 'Ruangan tidak ditemukan'; // Atur pesan default jika ruangan tidak ditemukan
            }
        }

        // Menentukan apakah tombol tambah harus ditampilkan
        $show_tambah = $this->showTambahButton($peminjaman);

        // Mengirimkan data ke tampilan
        $data = [
            'peminjaman' => $peminjaman,
            'show_tambah' => $show_tambah
        ];

        return view('pengguna/view_pengguna_data_peminjaman', $data);
    }

    // Fungsi untuk mengecek apakah ruangan sedang dipinjam
    private function isRuanganDipinjam($id_ruangan)
    {
        $peminjaman = $this->peminjaman->where('ruangan_dipinjam', $id_ruangan)
                                        ->whereIn('status_pinjam', ['disetujui', 'sedang dipinjam'])
                                        ->first();
        return !empty($peminjaman);
    }

    private function showTambahButton($peminjaman)
    {
        $latestStatus = count($peminjaman) > 0 ? $peminjaman[0]['status_pinjam'] : '';

        // Jika status peminjaman terbaru adalah 'selesai', maka tampilkan tombol tambah
        return $latestStatus != 'menunggu' && $latestStatus != 'disetujui';
    }

    public function tambah()
    {
        $data['fullname'] = $this->currentUser; // mendapatkan nama lengkap (fullname) pengguna saat ini

        // Dapatkan semua tempat dari Model_Tempat
        $tempat = $this->tempat->findAll();
        $tempat_tidak_dipinjam = [];
        $tempat_dipinjam = [];
        
        // Memisahkan ruangan yang sedang dipinjam dan yang tidak
        foreach ($tempat as $item) {
            if ($this->isRuanganDipinjam($item['id_ruangan'])) {
                $tempat_dipinjam[] = $item;
            } else {
                $tempat_tidak_dipinjam[] = $item;
            }
        }

        $data['tempat'] = $tempat_tidak_dipinjam;
        $data['tempat_dipinjam'] = $tempat_dipinjam;

        return view('pengguna/form_tambah_peminjaman', $data);
    }

    public function simpan()
    {
        // Validasi upload file PDF
        if ($this->validate([
            'pdf_file' => 'uploaded[pdf_file]|mime_in[pdf_file,application/pdf]|max_size[pdf_file,2048]'
        ])) {
            $pdfFile = $this->request->getFile('pdf_file');
            if ($pdfFile) {
                $pdfFileName = $pdfFile->getRandomName();
                $pdfFile->move(ROOTPATH . 'public/uploads', $pdfFileName);
            } else {
                $pdfFileName = '';
            }

            // Generate ID peminjaman baru
            $lastPeminjaman = $this->peminjaman->orderBy('id_peminjaman', 'DESC')->first();
            if ($lastPeminjaman) {
                $lastId = intval(substr($lastPeminjaman['id_peminjaman'], 5));
                $newId = 'SIPT-' . str_pad($lastId + 1, 5, '0', STR_PAD_LEFT);
            } else {
                // Jika tidak ada data yang ditemukan, mulailah dengan SIPT-0001
                $newId = 'SIPT-00001';
            }

            // Data untuk disimpan
            $data = [
                'id_peminjaman' => $newId,
                'peminjam' => $this->currentUser,
                'ruangan_dipinjam' => $this->request->getVar('ruangan_dipinjam'),
                'keterangan' => $this->request->getVar('keterangan'),
                'status_pinjam' => 'menunggu',
                'pdf_file' => $pdfFileName,
                'waktu_peminjaman' => $this->request->getVar('waktu_peminjaman'),
                'waktu_pengembalian' => $this->request->getVar('waktu_pengembalian')
            ];

            // Insert data ke database
            $this->peminjaman->insert($data);
            return redirect()->to(site_url('pengguna_data_peminjaman'))->with('message', 'Data Peminjaman berhasil disimpan.');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    public function edit($id_peminjaman)
    {
        $peminjaman = $this->peminjaman->find($id_peminjaman);
        $tempat = $this->tempat->findAll();

        // Menambahkan atribut sedang_dipinjam pada setiap ruangan
        foreach ($tempat as &$t) {
            $t['sedang_dipinjam'] = $this->isRuanganDipinjam($t['id_ruangan']);
        }

        $data = [
            'peminjaman' => $peminjaman,
            'tempat' => $tempat
        ];

        return view('pengguna/form_edit_peminjaman', $data);
    }

    public function update($id_peminjaman)
    {
        $data = $this->request->getPost();
        
        // Validasi PDF file upload
        $pdfFile = $this->request->getFile('pdf_file');
        if ($pdfFile && !$pdfFile->hasMoved()) {
            $newName = $pdfFile->getRandomName();
            $pdfFile->move(ROOTPATH . 'public/uploads', $newName);
            $data['pdf_file'] = $newName;
        } else {
            $data['pdf_file'] = $this->request->getPost('existing_pdf_file');
        }

        $this->peminjaman->update($id_peminjaman, $data);
        
        return redirect()->to(site_url('pengguna_data_peminjaman'));
    }

    public function delete($id)
    {
        $peminjaman = $this->peminjaman->find($id);
        if ($peminjaman['peminjam'] != $this->currentUser) {
            return redirect()->to(site_url('pengguna_data_peminjaman'))->with('error', 'Anda tidak memiliki izin untuk menghapus data ini.');
        }

        $this->peminjaman->delete($id);
        return redirect()->to(site_url('pengguna_data_peminjaman'))->with('message', 'Data Peminjaman berhasil dihapus.');
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Model_Tempat;

class admin_data_tempat extends BaseController
{
    public function __construct()
    {
        $this->tempat = new Model_Tempat();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_tb_ruangan') ? $this->request->getVar('page_tb_ruangan') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $tempat = $this->tempat->search($keyword);
        } else {
            $tempat = $this->tempat;
        }

        $data = [
            'tempat' => $this->tempat->paginate(20, 'tb_ruangan'),
            'pager' => $this->tempat->pager,
            'currentPage' => $currentPage
        ];

        return view('admin/view_admin_data_tempat', $data);
    }

    public function formtambah()
    {
        return view('admin/form_tambah_tempat');
    }

    public function simpandata()
    {
        $validationRules = [
            'id_ruangan' => 'required',
            'nama_ruangan' => 'required',
            'gambar_ruangan' => 'uploaded[gambar_ruangan]|max_size[gambar_ruangan,1024]|is_image[gambar_ruangan]'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        $gambar = $this->request->getFile('gambar_ruangan');
        $gambar->move(ROOTPATH . 'public/uploads/image');

        $data = [
            'id_ruangan' => $this->request->getPost('id_ruangan'),
            'nama_ruangan' => $this->request->getPost('nama_ruangan'),
            'gambar_ruangan' => $gambar->getName(),
            'status' => 'Tersedia'
        ];

        $this->tempat->insert($data);

        return redirect()->to('/admin_data_tempat')->with('sukses', 'Data Tempat berhasil disimpan.');
    }

    public function formedit($id)
    {
        $tempat = $this->tempat->find($id);

        if ($tempat) {
            $data = [
                'id' => $id,
                'id_ruangan' => $tempat['id_ruangan'],
                'nama_ruangan' => $tempat['nama_ruangan'],
                'gambar_ruangan' => $tempat['gambar_ruangan'],
                'status' => $tempat['status']
            ];

            return view('admin/form_edit_data_tempat', $data);
        } else {
            exit('Data tidak ditemukan');
        }
    }

    public function updatedata()
    {
        $id_ruangan = $this->request->getPost('id_ruangan');
        $tempat = $this->tempat->find($id_ruangan);

        if ($tempat) {
            $gambar_ruangan = $this->request->getFile('gambar_ruangan');
            if ($gambar_ruangan && $gambar_ruangan->isValid() && !$gambar_ruangan->hasMoved()) {
                //validasi gambar
                $validationRules = [
                    'gambar_ruangan' => 'uploaded[gambar_ruangan]|max_size[gambar_ruangan,1024]|is_image[gambar_ruangan]'
                ];

                if (!$this->validate($validationRules)) {
                    return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
                }

                // Pindahkan gambar baru
                $gambar_ruangan->move(ROOTPATH . 'public/uploads/image');

                // Hapus gambar lama jika ada gambar baru
                if ($tempat['gambar_ruangan']) {
                    unlink(ROOTPATH . 'public/uploads/image/' . $tempat['gambar_ruangan']);
                }

                // Update data termasuk gambar baru
                $data = [
                    'nama_ruangan' => $this->request->getPost('nama_ruangan'),
                    'gambar_ruangan' => $gambar_ruangan->getName()
                ];
            } else {
                // Jika tidak ada gambar yang diunggah, update data tanpa gambar baru
                $data = [
                    'nama_ruangan' => $this->request->getPost('nama_ruangan')
                ];
            }

            // Lakukan update data
            $this->tempat->update($id_ruangan, $data);

            return redirect()->to('/admin_data_tempat')->with('sukses', 'Data Tempat berhasil diperbarui.');
        } else {
            exit('Data tidak ditemukan');
        }
    }


    public function hapus($id)
    {
        $rowData = $this->tempat->find($id);

        if ($rowData) {
            $this->tempat->delete($id);

            session()->setFlashdata('sukses', 'Data berhasil dihapus.');

            return redirect()->to('/admin_data_tempat');
        } else {
            exit('Data tidak ditemukan');
        }
    }

    
}

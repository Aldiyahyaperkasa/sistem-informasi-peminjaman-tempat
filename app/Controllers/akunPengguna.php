<?php

namespace App\Controllers;

use App\Models\Model_User;
use CodeIgniter\Controller;

class akunPengguna extends BaseController
{
    public function __construct()
    {
        $this->Users = new Model_User();
    }

    public function index()
    {
        $levelFilter = $this->request->getVar('level');
        if ($levelFilter) {
            $data = [
                'tampildata' => $this->Users->where('level', $levelFilter)->findAll(),
                'selectedLevel' => $levelFilter
            ];
        } else {
            $data = [
                'tampildata' => $this->Users->findAll(),
                'selectedLevel' => null
            ];
        }

        return view('admin/viewakunPengguna', $data);
    }

    public function formtambah()
    {
        return view('admin/formtambahakunPengguna');
    }

    public function simpandata()
    {
        $username = $this->request->getVar('username');
        $fullname = $this->request->getVar('fullname');
        $level = $this->request->getVar('level');
        $password = $this->request->getVar('password');

        // Validasi input
        $validationRules = [
            'username' => 'required|min_length[4]|max_length[50]',
            'fullname' => 'required|min_length[4]|max_length[50]',
            'level' => 'required|in_list[Pengguna Ruangan,Bagian Umum]',
            'password' => 'required|min_length[4]|max_length[16]'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->to('/akunPengguna/formtambah')->withInput()->with('errors', $this->validator->getErrors());
        }

        // Simpan data ke dalam database
        $data = [
            'username' => $username,
            'fullname' => $fullname,
            'password' => md5($password),
            'level' => $level
        ];

        $this->Users->insert($data);

        // Set pesan sukses
        session()->setFlashdata([
            'sukses' => '<div class="alert alert-success">Data Berhasil Disimpan
                <button type="button" class="close" data-dismiss="alert" >x</button>
            </div>'
        ]);

        // Redirect ke halaman index
        return redirect()->to('/akunPengguna/index');
    }


    public function formedit($id)
    {
        $user = $this->Users->find($id);

        if ($user) {
            $data = [
                'id' => $id,
                'username' => $user->username,
                'fullname' => $user->fullname,
                'password' => $user->password,
                'level' => $user->level,
                // No need to include the password here
            ];

            return view('/admin/form_edit_akun_pengguna', $data);
        } else {
            exit('Data tidak ditemukan');
        }
    }

        public function updatedata()
    {
        $id = $this->request->getVar('id');
        $username = $this->request->getVar('username');
        $fullname = $this->request->getVar('fullname');
        $level = $this->request->getVar('level');
        $password = $this->request->getVar('password');

        // Validasi input
        $validationRules = [
            'username' => 'required|min_length[4]|max_length[50]',
            'fullname' => 'required|min_length[4]|max_length[50]',
            'level' => 'required|in_list[Pengguna Ruangan,Bagian Umum]',
        ];

        if (!empty($password)) {
            $validationRules['password'] = 'required|min_length[4]|max_length[16]';
        }

        if (!$this->validate($validationRules)) {
            return redirect()->to('/akunPengguna/formedit/' . $id)->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update data dalam database
        $data = [
            'username' => $username,
            'fullname' => $fullname,
            'level' => $level
        ];

        if (!empty($password)) {
            $data['password'] = md5($password);
        }

        $this->Users->update($id, $data);

        // Set pesan sukses
        session()->setFlashdata([
            'sukses' => '<div class="alert alert-success">Data Berhasil Diupdate
                <button type="button" class="close" data-dismiss="alert" >x</button>
            </div>'
        ]);

        // Redirect ke halaman index
        return redirect()->to('/akunPengguna/index');
    }


    public function hapus($id)
    {
        $rowData = $this->Users->find($id);

        if ($rowData) {
            $this->Users->delete($id);
            
            $pesan = [
                'sukses' => '<div class="alert alert-success">data berhasil Di hapus
                    <button type="button" class="close" data-dismiss="alert" >x</button>
                </div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/akunPengguna/index');
        } else {
            exit('data tidak ditemukan');
        }
    }
}

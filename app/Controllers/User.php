<?php

namespace App\Controllers;

use App\Models\ModelUsers;

class User extends BaseController
{
    public function __construct()
    {
        $this->Users = new ModelUsers();
    }
	public function index()
    {
        $data = [
            'tampildata' => $this->Users->findAll()
        ];
        return view('users/halaman-user', $data);
    }

    public function formtambah()
    {
        return view ('users/formtambah');
    }
    public function simpandata ()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required|min_length[4]|max_length[50]|is_unique[tb_users.username]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 50 Karakter',
                    'is_unique' => 'Username sudah digunakan sebelumnya'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[4]|max_length[16]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 16 Karakter',
                ]
            ],            
            'name' => [
                'rules' => 'required|min_length[4]|max_length[50]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 50 Karakter',
                ]
            ],            
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $users = new ModelUsers();
        $users->insert([
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'name' => $this->request->getVar('name'),
        ]);
        return redirect()->to('user');
    }

    public function formedit($id)
    {
        $user = $this->Users->find($id);

        if ($user) {
            $data = [
                'id' => $id,
                'username' => $user->username,
                'name' => $user->name,
                // No need to include the password here
            ];

            return view('/users/formedit', $data);
        } else {
            exit('Data tidak ditemukan');
        }
    }

    public function updatedata()
    {
        $id = $this->request->getVar('id');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $name = $this->request->getVar('name');
        
        // Menggunakan password_hash untuk mengenkripsi password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $validation = \Config\Services::validation();

        $valid = $this->validate([
            'username' => [
                'rules' => 'required',
                'label' => 'username',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'label' => 'password',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'name' => [
                'rules' => 'required',
                'label' => 'name',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ]
        ]);

        if (!$valid) {
            $pesan = [
                'errorEmail' => $validation->getErrors()
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/users/formedit/' . $id);
        } else {
            $this->Users->update($id, [
                'username' => $username,
                'password' => $hashedPassword, // Menyimpan password yang telah di-hash
                'name' => $name// Menyimpan password yang telah di-hash
            ]);

            $pesan = [
                'sukses' => '<div class="alert alert-success">Data Berhasil Diupdate
                    <button type="button" class="close" data-dismiss="alert" >x</button>
                </div>'
            ];

            session()->setFlashdata($pesan);
            return redirect()->to('/user/index');
        }
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
            return redirect()->to('/user/index');

        } else {
            exit('data tidak ditemukan');
        }
    }

}
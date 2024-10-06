<?php

namespace App\Controllers;

use App\Models\Model_User;

class Register extends BaseController
{
    public function index()
    {
        return view('register');
    }

    public function proses()
    {
        $model = new Model_User();

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required|is_unique[tb_user.username]',
            'fullname' => 'required',
            'password' => 'required|min_length[1]',
            'confirm_password' => 'required|matches[password]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('message', $validation->listErrors());
        }

        //Buat pengguna 
        $data = [
            'username' => $this->request->getPost('username'),
            'fullname' => $this->request->getPost('fullname'),
            'password' => md5($this->request->getPost('password')),
            'level'    => 'Pengguna Ruangan', // Default user level
        ];

        $model->insert($data);

        return redirect()->to('/login')->with('message', 'Registrasi berhasil. Silakan login.');
    }
}

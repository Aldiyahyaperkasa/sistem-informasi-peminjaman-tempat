<?php

namespace App\Controllers;

use App\Models\Model_User;
use CodeIgniter\Controller;

class Login extends BaseController
{
    protected $Users;

    public function __construct()
    {
        $this->Users = new Model_User();
    }

    public function index()
    {
        echo view('login');
    }

    public function proses()
    {
        $session = session();
        

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Memeriksa data login apakah sesuai dengan database
        $periksa = $this->Users->periksa_login($username, $password);

        // Menyimpan session login jika login berhasil
        if ($periksa !== null) {
            $sesi = [
                'fullname' => $periksa->fullname,
                'level' => $periksa->level,
                'status_masuk' => 'masuk' // Sesuaikan dengan nama sesi yang diinginkan
            ];

            // Set session 'username' di sini
            session()->set('username', $username);
            $session->set($sesi);

            // Redirect ke halaman yang sesuai dengan level pengguna
            switch ($periksa->level) {
                case 'Bagian Umum':
                    return redirect()->to('admin');
                    break;
                case 'Pengguna Ruangan':
                    return redirect()->to('pengguna');
                    break;
                default:
                    // Jika level tidak sesuai, kembalikan pengguna ke halaman login dengan pesan kesalahan
                    return redirect()->to('login')->with('gagal', 'Tidak dapat mengidentifikasi level pengguna.');
            }
        } else {
            // Tampilkan pesan kesalahan jika login gagal
            return redirect()->to('login')->with('gagal', 'Username atau password salah.');
        }
    }


    function logout()
    {
        session()->destroy();
        return redirect()->to('/login/index');
    }
}

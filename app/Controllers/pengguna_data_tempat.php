<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Model_Tempat;
use App\Models\Model_Peminjaman;

class Pengguna_data_tempat extends BaseController
{
    protected $tempat;
    protected $peminjamanModel;


    public function __construct()
    {
        $this->tempat = new Model_Tempat();
        $this->peminjamanModel = new Model_Peminjaman();

    }

    public function index()
    {
        $data = [
            'tempat' => $this->tempat->findAll(),
            'peminjaman' => $this->peminjamanModel->getApprovedPeminjaman()
        ];
        return view('pengguna/view_pengguna_data_tempat', $data);
    }   
}

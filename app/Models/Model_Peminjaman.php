<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_Peminjaman extends Model
{
    protected $table = 'tb_peminjaman';
    protected $primaryKey = 'id_peminjaman';
    protected $allowedFields = [
        'id_peminjaman', 'peminjam', 'ruangan_dipinjam', 'keterangan', 'status_pinjam', 'pdf_file', 'waktu_peminjaman', 'waktu_pengembalian', 'alasan_penolakan'
    ];

    public function getApprovedPeminjaman()
{
    return $this->where('status_pinjam', 'disetujui')->findAll();
}

}

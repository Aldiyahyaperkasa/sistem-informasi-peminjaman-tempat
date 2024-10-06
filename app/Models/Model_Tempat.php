<?php
namespace App\Models;

use CodeIgniter\Model;

class Model_Tempat extends Model
{
    protected $table = 'tb_ruangan';
    protected $primaryKey = 'id_ruangan';
    protected $allowedFields = [
        'id_ruangan', 'nama_ruangan', 'gambar_ruangan', 'status'
    ];

    public function getAllTempat()
    {
        return $this->findAll();
    }

    public function updateStatus($id_ruangan, $status)
    {
        return $this->update($id_ruangan, ['status' => $status]);
    }
}

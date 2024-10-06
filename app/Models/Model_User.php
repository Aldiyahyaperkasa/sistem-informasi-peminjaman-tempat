<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_User extends Model
{
    protected $table      = 'tb_user';
    protected $primaryKey = 'username';
    protected $returnType = 'object';
    protected $useTimestamps = false;
    protected $allowedFields = [
        'username', 'fullname', 'password', 'level'
    ];

    // Method untuk memeriksa login
    public function periksa_login($username, $password)
    {
        $user = $this->where('username', $username)
                     ->where('password', md5($password))
                     ->first();

        return $user;
    }

    public function getUserFullName($username)
    {
        return $this->where('username', $username)->first()['fullname'];
    }
}

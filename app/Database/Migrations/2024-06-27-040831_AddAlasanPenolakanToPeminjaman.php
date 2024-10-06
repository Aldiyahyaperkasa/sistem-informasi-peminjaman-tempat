<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAlasanPenolakanToPeminjaman extends Migration
{
    public function up()
    {
        $this->forge->addColumn('peminjaman', [
            'alasan_penolakan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('peminjaman', 'alasan_penolakan');
    }
}

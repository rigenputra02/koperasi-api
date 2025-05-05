<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Denda extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_denda'      => ['type' => 'INT', 'auto_increment' => true],
            'id_pinjaman'   => ['type' => 'INT'],
            'jumlah_denda'  => ['type' => 'DECIMAL', 'constraint' => '12,2'],
            'tanggal_denda' => ['type' => 'DATE'],
        ]);
        $this->forge->addKey('id_denda', true);
        $this->forge->addForeignKey('id_pinjaman', 'pinjaman', 'id_pinjaman', 'CASCADE', 'CASCADE');
        $this->forge->createTable('denda');

    }

    public function down()
    {
        $this->forge->dropTable('denda');
    }
}

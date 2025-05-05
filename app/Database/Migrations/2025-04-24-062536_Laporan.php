<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Laporan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_laporan'    => ['type' => 'INT', 'auto_increment' => true],
            'isi_laporan'   => ['type' => 'TEXT'],
            'jenis_laporan' => ['type' => 'VARCHAR', 'constraint' => 100],
            'periode'       => ['type' => 'VARCHAR', 'constraint' => 50],
            'id_petugas'    => ['type' => 'INT'],
        ]);
        $this->forge->addKey('id_laporan', true);
        $this->forge->addForeignKey('id_petugas', 'petugas', 'id_petugas', 'CASCADE', 'CASCADE');
        $this->forge->createTable('laporan');

    }

    public function down()
    {
        $this->forge->dropTable('laporan'); } }
<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pinjaman extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pinjaman'       => ['type' => 'INT', 'auto_increment' => true],
            'id_user'           => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true],
            'tanggal_pengajuan' => ['type' => 'DATE'],
            'tenor'             => ['type' => 'INT'],
            'jumlah_pinjaman'   => ['type' => 'DECIMAL', 'constraint' => '12,2'],
            'status'            => ['type' => 'VARCHAR', 'constraint' => 50],
            'bunga'             => ['type' => 'DECIMAL', 'constraint' => '5,2'],
        ]);
        $this->forge->addKey('id_pinjaman', true);
        $this->forge->addForeignKey('id_user', 'user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pinjaman');

    }

    public function down()
    {
        $this->forge->dropTable('pinjaman');
    }
}

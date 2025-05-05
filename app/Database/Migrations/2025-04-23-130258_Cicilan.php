<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cicilan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_cicilan'         => ['type' => 'INT', 'auto_increment' => true],
            'id_pinjaman'        => ['type' => 'INT'],
            'tanggal_pembayaran' => ['type' => 'DATE'],
            'jumlah_bayar'       => ['type' => 'DECIMAL', 'constraint' => '12,2'],
            'status_denda'       => ['type' => 'VARCHAR', 'constraint' => 50],
        ]);
        $this->forge->addKey('id_cicilan', true);
        $this->forge->addForeignKey('id_pinjaman', 'pinjaman', 'id_pinjaman', 'CASCADE', 'CASCADE');
        $this->forge->createTable('cicilan');

    }

    public function down()
    {
        $this->forge->dropTable('cicilan');
    }
}

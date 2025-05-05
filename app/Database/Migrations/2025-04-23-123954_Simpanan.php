<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Simpanan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_simpanan'      => ['type' => 'INT', 'auto_increment' => true],
            'id_user'          => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true],
            'jenis_simpanan'   => ['type' => 'VARCHAR', 'constraint' => 50],
            'jumlah'           => ['type' => 'DECIMAL', 'constraint' => '12,2'],
            'tanggal_simpanan' => ['type' => 'DATE', 'null' => true],
            'status'           => ['type' => 'VARCHAR', 'constraint' => 50],
        ]);
        $this->forge->addKey('id_simpanan', true);
        $this->forge->addForeignKey('id_user', 'user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('simpanan');

    }

    public function down()
    {
        $this->forge->dropTable('simpanan');
    }
}
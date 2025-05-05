<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Distribusi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_distribusi'    => ['type' => 'INT', 'auto_increment' => true],
            'id_user'          => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true],
            'id_shu'           => ['type' => 'INT'],
            'jumlah_diterima'  => ['type' => 'DECIMAL', 'constraint' => '12,2'],
        ]);
        $this->forge->addKey('id_distribusi', true);
        $this->forge->addForeignKey('id_user', 'user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_shu', 'shu', 'id_shu', 'CASCADE', 'CASCADE');
        $this->forge->createTable('distribusi_shu');

    }

    public function down()
    {
        $this->forge->dropTable('distribusi_shu');
    }
}

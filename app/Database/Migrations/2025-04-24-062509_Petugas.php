<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Petugas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_petugas' => ['type' => 'INT', 'auto_increment' => true],
            'nama'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'email'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'password'   => ['type' => 'VARCHAR', 'constraint' => 100],
        ]);
        $this->forge->addKey('id_petugas', true);
        $this->forge->createTable('petugas');

    }

    public function down()
    {
        $this->forge->dropTable('petugas');
    }
}

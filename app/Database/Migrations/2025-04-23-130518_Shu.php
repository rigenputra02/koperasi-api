<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Shu extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_shu'              => ['type' => 'INT', 'auto_increment' => true],
            'tanggal_perhitungan' => ['type' => 'DATE'],
            'tahun'               => ['type' => 'INT'],
            'total_shu'           => ['type' => 'DECIMAL', 'constraint' => '15,2'],
        ]);
        $this->forge->addKey('id_shu', true);
        $this->forge->createTable('shu');

    }

    public function down()
    {
        $this->forge->dropTable('shu');

    }
}

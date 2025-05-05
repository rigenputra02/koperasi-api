<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InfoPupuk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pupuk'       => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'nama_pupuk'     => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'jenis_pupuk'    => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => true,
            ],
            'harga_per_kg'   => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => false,
            ],
            'satuan'         => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'kg',
            ],
            'tanggal_update' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'sumber'         => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status'         => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'aktif',
            ],
        ]);

        $this->forge->addKey('id_pupuk', true);
        $this->forge->createTable('info_pupuk');

    }

    public function down()
    {
        $this->forge->dropTable('info_pupuk');
    }
}

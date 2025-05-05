<?php

namespace App\Models;

use CodeIgniter\Model;

class Shu extends Model
{
    protected $table            = 'shu';
    protected $primaryKey       = 'id_shu';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ["tanggal_perhitungan", "tahun", "total_shu"];

    // Dates
    // protected $useTimestamps = true;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
}

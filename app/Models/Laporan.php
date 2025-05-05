<?php

namespace App\Models;

use CodeIgniter\Model;

class Laporan extends Model
{
    protected $table            = 'laporan';
    protected $primaryKey       = 'id_laporan';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['isi_laporan', 'jenis_laporan', 'periode', 'id_petugas'];
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}

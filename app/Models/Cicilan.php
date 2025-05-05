<?php

namespace App\Models;

use CodeIgniter\Model;

class Cicilan extends Model
{
    protected $table            = 'cicilan';
    protected $primaryKey       = 'id_cicilan';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_pinjaman', 'tgl_cicilan', 'jumlah_cicilan'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}

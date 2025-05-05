<?php

namespace App\Models;

use CodeIgniter\Model;

class Simpanan extends Model
{
    protected $table            = 'simpanan';
    protected $primaryKey       = 'id_simpanan';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_user', 'jenis_simpanan', 'jumlah', 'tanggal_simpanan', 'status'];

    // Dates
//     protected $useTimestamps = true;
//     protected $dateFormat    = 'datetime';
//     protected $createdField  = 'created_at';
//     protected $updatedField = 'updated_at';
}

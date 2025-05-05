<?php

namespace App\Models;

use CodeIgniter\Model;

class Distribusi extends Model
{
    protected $table            = 'distribusi';
    protected $primaryKey       = 'id_distribusi';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_user', 'id_shu', 'jumlah_diterima'];
    // Dates
    // protected $useTimestamps = true;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
}

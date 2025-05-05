<?php

namespace App\Models;

use CodeIgniter\Model;

class Denda extends Model
{
    protected $table            = 'denda';
    protected $primaryKey       = 'id_denda';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_pinjaman', 'jumlah_denda', 'tanggal_denda'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}

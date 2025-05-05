<?php

namespace App\Models;

use CodeIgniter\Model;

class Pinjaman extends Model
{
    protected $table            = 'pinjaman';
    protected $primaryKey       = 'id_pinjaman';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['id_user', 'tanggal_pengajuan', 'tenor', 'jumlah_pinjaman', 'status', 'bunga'];

    // Dates
    // protected $useTimestamps = true;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
}

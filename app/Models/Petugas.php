<?php

namespace App\Models;

use CodeIgniter\Model;

class Petugas extends Model
{
    protected $table = 'petugas';
    protected $primaryKey = 'id_petugas';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['nama', 'email', 'password'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}

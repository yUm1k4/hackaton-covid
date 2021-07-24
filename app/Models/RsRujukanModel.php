<?php

namespace App\Models;

use CodeIgniter\Model;

class RsRujukanModel extends Model
{
    protected $table = 'rs_rujukan';
    protected $primaryKey = 'id_rs_rujukan';

    protected $allowedFields = [
        'nama', 'alamat', 'hotline'
    ];
}

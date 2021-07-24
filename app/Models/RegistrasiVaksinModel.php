<?php

namespace App\Models;

use CodeIgniter\Model;

class RegistrasiVaksinModel extends Model
{
    protected $table = 'registrasi_vaksin';
    protected $primaryKey = 'id_reg_vaksin';

    protected $allowedFields = [
        'user_id', 'nik', 'no_hp', 'alamat', 'status'
    ];

    protected $useTimestamps = true;
}

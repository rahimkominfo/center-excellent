<?php

namespace App\Models;

use CodeIgniter\Model;

class PpkModel extends Model
{
    protected $table            = 'ppk_data';
    protected $primaryKey       = 'ppk_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nip', 'unit_id', 'nama', 'jabatan', 'opd', 'tahun'];

    // Validation rules
    protected $validationRules      = [
        'nip'  => 'required|min_length[18]|max_length[18]|is_unique[ppk_data.nip,ppk_id,{ppk_id}]',
        'nama' => 'required',
    ];
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class PaketModel extends Model
{
    protected $table            = 'paket_data';
    protected $primaryKey       = 'paket_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'unit_id', 'kj_id', 'kd_mp', 'nm_paket', 'kode_rup', 
        'pagu', 'nilai_hps', 'nilai_kontrak', 'nm_pemenang', 
        'alamat_pemenang', 'no_hp_email', 'tahun'
    ];
}

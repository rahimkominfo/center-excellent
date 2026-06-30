<?php

namespace App\Models;

use CodeIgniter\Model;

class PenilaianModel extends Model
{
    protected $table            = 'penilaian_data';
    protected $primaryKey       = 'penilaian_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kontrak_id', 'kd_aspek_kinerja', 'kd_indikator_kinerja', 'nilai'];
}

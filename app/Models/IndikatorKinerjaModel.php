<?php

namespace App\Models;

use CodeIgniter\Model;

class IndikatorKinerjaModel extends Model
{
    protected $table            = 'indikator_kinerja';
    protected $primaryKey       = 'kd_indikator_kinerja';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kd_aspek_kinerja', 'nm_indikator', 'bobot_indikator'];
}

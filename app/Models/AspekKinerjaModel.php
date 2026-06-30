<?php

namespace App\Models;

use CodeIgniter\Model;

class AspekKinerjaModel extends Model
{
    protected $table            = 'aspek_kinerja';
    protected $primaryKey       = 'kd_aspek_kinerja';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kj_id', 'nm_aspek_kinerja', 'bobot'];
}

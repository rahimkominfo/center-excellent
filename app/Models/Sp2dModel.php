<?php

namespace App\Models;

use CodeIgniter\Model;

class Sp2dModel extends Model
{
    protected $table            = 'sp2d';
    protected $primaryKey       = 'sp2d_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kontrak_id', 'no_sp2d', 'tgl_sp2d', 'nilai_sp2d', 'file'];
}

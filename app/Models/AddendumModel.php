<?php

namespace App\Models;

use CodeIgniter\Model;

class AddendumModel extends Model
{
    protected $table            = 'kontrak_addendum';
    protected $primaryKey       = 'addendum_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kontrak_id', 'no_addendum', 'tgl_addendum', 'nilai_addendum', 
        'jaminan_addendum', 'tgl_mulai_addendum', 'tgl_akhir_addendum', 'wp_addendum'
    ];
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class KontrakModel extends Model
{
    protected $table            = 'kontrak_data';
    protected $primaryKey       = 'kontrak_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kj_id', 'nip', 'paket_id', 'sumber_anggaran', 'kemampuan_keuangan', 
        'ketersediaan_sdm', 'ketersediaan_sarpra', 'rekomendasi', 'update_penilaian', 
        'no_kontrak', 'tgl_kontrak', 'jaminan', 'tgl_mulai_kontrak', 'tgl_akhir_kontrak', 
        'waktu_pemeliharaan', 'no_bast', 'tgl_bast', 'hasil_penilaian', 'persen_penyelesaian'
    ];
}

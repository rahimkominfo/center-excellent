<?php

namespace App\Controllers;

use App\Models\KontrakModel;
use App\Models\PaketModel;
use App\Models\PpkModel;
use App\Models\AspekKinerjaModel;
use App\Models\IndikatorKinerjaModel;
use App\Models\PenilaianModel;
use App\Models\AddendumModel;
use App\Models\Sp2dModel;

class Dashboard extends BaseController
{
    // ==========================================
    // MAIN DASHBOARD HOME
    // ==========================================
    public function index(): string
    {
        $kontrakModel = new KontrakModel();
        $paketModel = new PaketModel();
        $ppkModel = new PpkModel();

        $stats = [
            'total_paket'   => $paketModel->countAllResults(),
            'total_kontrak' => $kontrakModel->countAllResults(),
            'total_ppk'     => $ppkModel->countAllResults(),
            'total_selesai' => $kontrakModel->where('persen_penyelesaian', 100)->countAllResults(),
        ];

        // Fetch recent contracts
        $recent_kontraks = $kontrakModel->select('kontrak_data.*, ppk_data.nama as ppk_nama, paket_data.nm_paket, paket_data.nilai_kontrak')
                                        ->join('ppk_data', 'ppk_data.nip = kontrak_data.nip', 'left')
                                        ->join('paket_data', 'paket_data.paket_id = kontrak_data.paket_id', 'left')
                                        ->orderBy('kontrak_id', 'DESC')
                                        ->limit(5)
                                        ->findAll();

        return view('dashboard/index', [
            'stats'           => $stats,
            'recent_kontraks' => $recent_kontraks
        ]);
    }

    // ==========================================
    // KONTRAK PPK LIST
    // ==========================================
    public function kontrak_ppk(): string
    {
        $kontrakModel = new KontrakModel();
        
        $search = $this->request->getGet('search');

        $builder = $kontrakModel->select('kontrak_data.*, ppk_data.nama as ppk_nama, 
                                         paket_data.nm_paket, paket_data.kode_rup, paket_data.pagu, paket_data.nilai_hps, paket_data.nilai_kontrak,
                                         paket_data.nm_pemenang, paket_data.alamat_pemenang, paket_data.no_hp_email,
                                         kontrak_jenis.nm_jenis_kontrak, ref_metode_pengadaan.nm_mp')
                               ->join('ppk_data', 'ppk_data.nip = kontrak_data.nip', 'left')
                               ->join('paket_data', 'paket_data.paket_id = kontrak_data.paket_id', 'left')
                               ->join('kontrak_jenis', 'kontrak_jenis.kj_id = kontrak_data.kj_id', 'left')
                               ->join('ref_metode_pengadaan', 'ref_metode_pengadaan.kd_mp = paket_data.kd_mp', 'left');

        $nip = session()->get('nip');
        if ($nip && (string)$nip !== '198202272005021004') {
            $builder = $builder->where('kontrak_data.nip', $nip);
        }

        if (!empty($search)) {
            $builder = $builder->groupStart()
                               ->like('paket_data.nm_paket', $search)
                               ->orLike('paket_data.nm_pemenang', $search)
                               ->orLike('ppk_data.nama', $search)
                               ->groupEnd();
        }

        $kontraks = $kontrakModel->paginate(10, 'default');
        $pager = $kontrakModel->pager;

        return view('dashboard/kontrak_ppk', [
            'kontraks' => $kontraks,
            'search'   => $search,
            'pager'    => $pager
        ]);
    }

    // ==========================================
    // LAPORAN MONITORING
    // ==========================================
    public function lap_monitoring(): string
    {
        $kontrakModel = new KontrakModel();
        
        $search = $this->request->getGet('search');

        $builder = $kontrakModel->select('kontrak_data.*, ppk_data.nama as ppk_nama, 
                                         paket_data.nm_paket, paket_data.pagu, paket_data.nilai_hps, paket_data.nilai_kontrak,
                                         paket_data.nm_pemenang, paket_data.alamat_pemenang,
                                         kontrak_jenis.nm_jenis_kontrak')
                               ->join('ppk_data', 'ppk_data.nip = kontrak_data.nip', 'left')
                               ->join('paket_data', 'paket_data.paket_id = kontrak_data.paket_id', 'left')
                               ->join('kontrak_jenis', 'kontrak_jenis.kj_id = kontrak_data.kj_id', 'left');

        $nip = session()->get('nip');
        if ($nip && (string)$nip !== '198202272005021004') {
            $builder = $builder->where('kontrak_data.nip', $nip);
        }

        if (!empty($search)) {
            $builder = $builder->groupStart()
                               ->like('paket_data.nm_paket', $search)
                               ->orLike('paket_data.nm_pemenang', $search)
                               ->groupEnd();
        }

        $kontraks = $kontrakModel->paginate(10, 'default');
        $pager = $kontrakModel->pager;

        return view('dashboard/lap_monitoring', [
            'kontraks' => $kontraks,
            'search'   => $search,
            'pager'    => $pager
        ]);
    }

    // ==========================================
    // LAPORAN TEPRA
    // ==========================================
    public function lap_tepra(): string
    {
        $kontrakModel = new KontrakModel();
        
        $search = $this->request->getGet('search');
        $filter_val = $this->request->getGet('filter_val') ?? 'all';

        $builder = $kontrakModel->select('kontrak_data.*, ppk_data.nama as ppk_nama, 
                                         paket_data.nm_paket, paket_data.pagu, paket_data.nilai_hps, paket_data.nilai_kontrak,
                                         paket_data.nm_pemenang,
                                         kontrak_jenis.nm_jenis_kontrak, ref_metode_pengadaan.nm_mp')
                               ->join('ppk_data', 'ppk_data.nip = kontrak_data.nip', 'left')
                               ->join('paket_data', 'paket_data.paket_id = kontrak_data.paket_id', 'left')
                               ->join('kontrak_jenis', 'kontrak_jenis.kj_id = kontrak_data.kj_id', 'left')
                               ->join('ref_metode_pengadaan', 'ref_metode_pengadaan.kd_mp = paket_data.kd_mp', 'left');

        $nip = session()->get('nip');
        if ($nip && (string)$nip !== '198202272005021004') {
            $builder = $builder->where('kontrak_data.nip', $nip);
        }

        if (!empty($search)) {
            $builder = $builder->groupStart()
                               ->like('paket_data.nm_paket', $search)
                               ->groupEnd();
        }

        if ($filter_val == '1') {
            $builder = $builder->where('paket_data.nilai_kontrak <', 200000000);
        } elseif ($filter_val == '2') {
            $builder = $builder->where('paket_data.nilai_kontrak >=', 200000000)->where('paket_data.nilai_kontrak <=', 2500000000);
        } elseif ($filter_val == '3') {
            $builder = $builder->where('paket_data.nilai_kontrak >', 2500000000);
        }

        $kontraks = $kontrakModel->paginate(10, 'default');
        $pager = $kontrakModel->pager;

        return view('dashboard/lap_tepra', [
            'kontraks'   => $kontraks,
            'search'     => $search,
            'filter_val' => $filter_val,
            'pager'      => $pager
        ]);
    }

    // ==========================================
    // RATING & ASSESSMENT CRUD
    // ==========================================
    public function penilaian_ppk(): string
    {
        $kontrak_id = $this->request->getGet('kontrak_id');
        
        $kontrakModel = new KontrakModel();
        $aspekModel = new AspekKinerjaModel();
        $indikatorModel = new IndikatorKinerjaModel();
        $penilaianModel = new PenilaianModel();

        $kontrak = $kontrakModel->select('kontrak_data.*, ppk_data.nama as ppk_nama, 
                                        paket_data.nm_paket, paket_data.nilai_kontrak, paket_data.nm_pemenang, ref_unit.unit_nama')
                                ->join('ppk_data', 'ppk_data.nip = kontrak_data.nip', 'left')
                                ->join('paket_data', 'paket_data.paket_id = kontrak_data.paket_id', 'left')
                                ->join('ref_unit', 'ref_unit.unit_id = paket_data.unit_id', 'left')
                                ->find($kontrak_id);

        if (!$kontrak) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Get indicators and aspects for this contract's kind of contract (kj_id)
        $indicators = $indikatorModel->select('indikator_kinerja.*, aspek_kinerja.nm_aspek_kinerja, aspek_kinerja.kj_id')
                                     ->join('aspek_kinerja', 'aspek_kinerja.kd_aspek_kinerja = indikator_kinerja.kd_aspek_kinerja')
                                     ->where('aspek_kinerja.kj_id', $kontrak['kj_id'])
                                     ->findAll();

        // Get existing ratings if any
        $ratings = $penilaianModel->where('kontrak_id', $kontrak_id)->findAll();
        $existing_ratings = [];
        foreach ($ratings as $r) {
            $existing_ratings[$r['kd_indikator_kinerja']] = $r['nilai'];
        }

        return view('dashboard/penilaian_ppk', [
            'kontrak'          => $kontrak,
            'indicators'       => $indicators,
            'existing_ratings' => $existing_ratings
        ]);
    }

    public function penilaian_ppk_store()
    {
        $kontrak_id = $this->request->getPost('kontrak_id');
        
        $kontrakModel = new KontrakModel();
        $penilaianModel = new PenilaianModel();
        $indikatorModel = new IndikatorKinerjaModel();

        $scores = $this->request->getPost('nilai'); // Array: [indikator_id => score]

        // Save individual scores
        $total_weighted_score = 0;
        $total_bobot = 0;

        if ($scores) {
            foreach ($scores as $ind_id => $score) {
                // Get indicator weight
                $indicator = $indikatorModel->find($ind_id);
                $weight = $indicator ? $indicator['bobot_indikator'] : 0;

                // Save or update score
                $existing = $penilaianModel->where([
                    'kontrak_id'           => $kontrak_id,
                    'kd_indikator_kinerja' => $ind_id
                ])->first();

                $data_rating = [
                    'kontrak_id'           => $kontrak_id,
                    'kd_aspek_kinerja'     => $indicator['kd_aspek_kinerja'],
                    'kd_indikator_kinerja' => $ind_id,
                    'nilai'                => $score
                ];

                if ($existing) {
                    $penilaianModel->update($existing['penilaian_id'], $data_rating);
                } else {
                    $penilaianModel->save($data_rating);
                }

                // Weighted score calculation
                $total_weighted_score += ($score * $weight) / 100;
                $total_bobot += $weight;
            }
        }

        // Normalize if total weights don't equal exactly 100%
        $final_score = ($total_bobot > 0) ? ($total_weighted_score * 100 / $total_bobot) : 0;

        // Save contract inputs
        $data_contract = [
            'kemampuan_keuangan'  => str_replace(['.', ','], '', $this->request->getPost('kemampuan_keuangan')),
            'ketersediaan_sdm'    => $this->request->getPost('ketersediaan_sdm'),
            'ketersediaan_sarpra' => $this->request->getPost('ketersediaan_sarpra'),
            'rekomendasi'         => $this->request->getPost('rekomendasi'),
            'hasil_penilaian'     => round($final_score, 2),
            'update_penilaian'    => 1
        ];

        $kontrakModel->update($kontrak_id, $data_contract);

        return redirect()->to(base_url('dashboard/kontrak_ppk'))->with('success', 'Penilaian kinerja vendor berhasil disimpan!');
    }

    // ==========================================
    // ADDENDUM CRUD
    // ==========================================
    public function addendum(): string
    {
        $kontrak_id = $this->request->getGet('kontrak_id');
        
        $kontrakModel = new KontrakModel();
        $addendumModel = new AddendumModel();

        $kontrak = $kontrakModel->select('kontrak_data.*, ppk_data.nama as ppk_nama, paket_data.nm_paket, paket_data.nilai_kontrak, ref_unit.unit_nama')
                                ->join('ppk_data', 'ppk_data.nip = kontrak_data.nip', 'left')
                                ->join('paket_data', 'paket_data.paket_id = kontrak_data.paket_id', 'left')
                                ->join('ref_unit', 'ref_unit.unit_id = paket_data.unit_id', 'left')
                                ->find($kontrak_id);

        if (!$kontrak) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $addendums = $addendumModel->where('kontrak_id', $kontrak_id)->findAll();

        return view('dashboard/addendum', [
            'kontrak'   => $kontrak,
            'addendums' => $addendums
        ]);
    }

    public function addendum_store()
    {
        $addendumModel = new AddendumModel();
        $kontrak_id = $this->request->getPost('kontrak_id');

        $data = [
            'kontrak_id'         => $kontrak_id,
            'no_addendum'        => $this->request->getPost('no_addendum'),
            'tgl_addendum'       => $this->request->getPost('tgl_addendum'),
            'nilai_addendum'     => str_replace(['.', ','], '', $this->request->getPost('nilai_addendum')),
            'jaminan_addendum'   => $this->request->getPost('jaminan_addendum'),
            'tgl_mulai_addendum' => $this->request->getPost('tgl_mulai_addendum'),
            'tgl_akhir_addendum' => $this->request->getPost('tgl_akhir_addendum'),
            'wp_addendum'        => $this->request->getPost('wp_addendum') ?? 0,
        ];

        if ($addendumModel->save($data)) {
            return redirect()->to(base_url('dashboard/addendum?kontrak_id=' . $kontrak_id))->with('success', 'Addendum kontrak berhasil ditambahkan!');
        }
        return redirect()->to(base_url('dashboard/addendum?kontrak_id=' . $kontrak_id))->with('error', 'Gagal menambahkan addendum kontrak.');
    }

    public function addendum_delete($id)
    {
        $addendumModel = new AddendumModel();
        $addendum = $addendumModel->find($id);
        $kontrak_id = $addendum ? $addendum['kontrak_id'] : 1;

        if ($addendumModel->delete($id)) {
            return redirect()->to(base_url('dashboard/addendum?kontrak_id=' . $kontrak_id))->with('success', 'Addendum kontrak berhasil dihapus!');
        }
        return redirect()->to(base_url('dashboard/addendum?kontrak_id=' . $kontrak_id))->with('error', 'Gagal menghapus addendum.');
    }

    // ==========================================
    // SP2D CRUD
    // ==========================================
    public function sp2d(): string
    {
        $kontrak_id = $this->request->getGet('kontrak_id');
        
        $kontrakModel = new KontrakModel();
        $sp2dModel = new Sp2dModel();

        $kontrak = $kontrakModel->select('kontrak_data.*, ppk_data.nama as ppk_nama, paket_data.nm_paket, paket_data.nilai_kontrak, ref_unit.unit_nama')
                                ->join('ppk_data', 'ppk_data.nip = kontrak_data.nip', 'left')
                                ->join('paket_data', 'paket_data.paket_id = kontrak_data.paket_id', 'left')
                                ->join('ref_unit', 'ref_unit.unit_id = paket_data.unit_id', 'left')
                                ->find($kontrak_id);

        if (!$kontrak) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $sp2ds = $sp2dModel->where('kontrak_id', $kontrak_id)->findAll();

        return view('dashboard/sp2d', [
            'kontrak' => $kontrak,
            'sp2ds'   => $sp2ds
        ]);
    }

    public function sp2d_store()
    {
        $sp2dModel = new Sp2dModel();
        $kontrak_id = $this->request->getPost('kontrak_id');

        $file_name = '';
        $file = $this->request->getFile('file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $file_name = $file->getRandomName();
            
            // Ensure uploads directory exists
            $upload_path = ROOTPATH . 'public/uploads';
            if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
            }

            $file->move($upload_path, $file_name);
        }

        $data = [
            'kontrak_id' => $kontrak_id,
            'no_sp2d'    => $this->request->getPost('no_sp2d'),
            'tgl_sp2d'   => $this->request->getPost('tgl_sp2d'),
            'nilai_sp2d' => str_replace(['.', ','], '', $this->request->getPost('nilai_sp2d')),
            'file'       => $file_name,
        ];

        if ($sp2dModel->save($data)) {
            return redirect()->to(base_url('dashboard/sp2d?kontrak_id=' . $kontrak_id))->with('success', 'Berkas SP2D berhasil diupload!');
        }
        return redirect()->to(base_url('dashboard/sp2d?kontrak_id=' . $kontrak_id))->with('error', 'Gagal mengupload berkas SP2D.');
    }

    public function sp2d_delete($id)
    {
        $sp2dModel = new Sp2dModel();
        $sp2d = $sp2dModel->find($id);
        $kontrak_id = $sp2d ? $sp2d['kontrak_id'] : 1;

        if ($sp2dModel->delete($id)) {
            if (!empty($sp2d['file']) && file_exists(ROOTPATH . 'public/uploads/' . $sp2d['file'])) {
                unlink(ROOTPATH . 'public/uploads/' . $sp2d['file']);
            }
            return redirect()->to(base_url('dashboard/sp2d?kontrak_id=' . $kontrak_id))->with('success', 'Berkas SP2D berhasil dihapus!');
        }
        return redirect()->to(base_url('dashboard/sp2d?kontrak_id=' . $kontrak_id))->with('error', 'Gagal menghapus berkas SP2D.');
    }

    // ==========================================
    // EDIT KONTRAK & EDIT PAKET ACTIONS
    // ==========================================
    public function form_edit_kontrak(): string
    {
        $kontrak_id = $this->request->getGet('kontrak_id');
        $kontrakModel = new KontrakModel();
        
        $kontrak = $kontrakModel->select('kontrak_data.*, ppk_data.nama as ppk_nama, paket_data.nm_paket, paket_data.nilai_kontrak, ref_unit.unit_nama')
                                ->join('ppk_data', 'ppk_data.nip = kontrak_data.nip', 'left')
                                ->join('paket_data', 'paket_data.paket_id = kontrak_data.paket_id', 'left')
                                ->join('ref_unit', 'ref_unit.unit_id = paket_data.unit_id', 'left')
                                ->find($kontrak_id);

        return view('dashboard/form_edit_kontrak', [
            'kontrak' => $kontrak
        ]);
    }

    public function form_edit_kontrak_update()
    {
        $kontrakModel = new KontrakModel();
        $kontrak_id = $this->request->getPost('kontrak_id');

        $data = [
            'no_kontrak'         => $this->request->getPost('no_kontrak'),
            'tgl_kontrak'        => $this->request->getPost('tgl_kontrak') ?: null,
            'jaminan'            => $this->request->getPost('jaminan'),
            'tgl_mulai_kontrak'  => $this->request->getPost('tgl_mulai_kontrak') ?: null,
            'tgl_akhir_kontrak'  => $this->request->getPost('tgl_akhir_kontrak') ?: null,
            'waktu_pemeliharaan' => $this->request->getPost('waktu_pemeliharaan'),
            'no_bast'            => $this->request->getPost('no_bast'),
            'tgl_bast'           => $this->request->getPost('tgl_bast') ?: null,
            'persen_penyelesaian'=> $this->request->getPost('persen_penyelesaian') ?? 0,
        ];

        $kontrakModel->update($kontrak_id, $data);
        return redirect()->to(base_url('dashboard/kontrak_ppk'))->with('success', 'Kontrak berhasil diperbarui!');
    }

    public function form_edit_paket(): string
    {
        $paket_id = $this->request->getGet('paket_id');
        $paketModel = new PaketModel();
        $db = \Config\Database::connect();

        $paket = $paketModel->find($paket_id);
        $units = $db->table('ref_unit')->get()->getResultArray();
        $jenis_kontrak = $db->table('kontrak_jenis')->get()->getResultArray();
        $metode_pengadaan = $db->table('ref_metode_pengadaan')->get()->getResultArray();

        return view('dashboard/form_edit_paket', [
            'paket'             => $paket,
            'units'             => $units,
            'jenis_kontrak'     => $jenis_kontrak,
            'metode_pengadaan'  => $metode_pengadaan
        ]);
    }

    public function form_edit_paket_update()
    {
        $paketModel = new PaketModel();
        $paket_id = $this->request->getPost('paket_id');

        $data = [
            'nm_paket'        => $this->request->getPost('nm_paket'),
            'unit_id'         => $this->request->getPost('unit_id'),
            'kj_id'           => $this->request->getPost('kj_id'),
            'kd_mp'           => $this->request->getPost('kd_mp'),
            'kode_rup'        => $this->request->getPost('kode_rup'),
            'pagu'            => str_replace(['.', ','], '', $this->request->getPost('pagu')),
            'nilai_hps'       => str_replace(['.', ','], '', $this->request->getPost('nilai_hps')),
            'nilai_kontrak'   => str_replace(['.', ','], '', $this->request->getPost('nilai_kontrak')),
            'nm_pemenang'     => $this->request->getPost('nm_pemenang'),
            'alamat_pemenang' => $this->request->getPost('alamat_pemenang'),
            'no_hp_email'     => $this->request->getPost('no_hp_email'),
            'tahun'           => $this->request->getPost('tahun'),
        ];

        $paketModel->update($paket_id, $data);
        return redirect()->to(base_url('dashboard/kontrak_ppk'))->with('success', 'Paket pekerjaan berhasil diperbarui!');
    }
}

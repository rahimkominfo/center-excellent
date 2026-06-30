<?php

namespace App\Controllers;

use App\Models\PpkModel;
use App\Models\PaketModel;
use App\Models\KontrakModel;

class Kontrak extends BaseController
{
    // ==========================================
    // KONTRAK MAPPING (INDEX)
    // ==========================================
    public function index(): string
    {
        $kontrakModel = new KontrakModel();
        $paketModel = new PaketModel();
        $ppkModel = new PpkModel();

        // Get contracts with joined PPK and Paket details
        $kontraks = $kontrakModel->select('kontrak_data.*, ppk_data.nama as ppk_nama, ppk_data.nip as ppk_nip, paket_data.nm_paket')
                                 ->join('ppk_data', 'ppk_data.nip = kontrak_data.nip', 'left')
                                 ->join('paket_data', 'paket_data.paket_id = kontrak_data.paket_id', 'left')
                                 ->findAll();

        $pakets = $paketModel->findAll();
        $ppks = $ppkModel->findAll();

        return view('admin/kontrak/index', [
            'kontraks' => $kontraks,
            'pakets'   => $pakets,
            'ppks'     => $ppks
        ]);
    }

    public function store()
    {
        $kontrakModel = new KontrakModel();

        $data = [
            'paket_id'        => $this->request->getPost('paket_id'),
            'nip'             => $this->request->getPost('nip'),
            'sumber_anggaran' => $this->request->getPost('sumber_anggaran'),
            'kj_id'           => 1, // Default jenis kontrak (Penyedia)
            'rekomendasi'     => '',
            'ketersediaan_sdm'=> '',
            'ketersediaan_sarpra' => '',
            'no_kontrak'      => '',
            'jaminan'         => '',
            'no_bast'         => '',
        ];

        if ($kontrakModel->save($data)) {
            return redirect()->to(base_url('kontrak'))->with('success', 'Kontrak pekerjaan berhasil dipetakan!');
        } else {
            return redirect()->to(base_url('kontrak'))->with('error', 'Gagal memetakan kontrak pekerjaan.');
        }
    }

    public function delete($id)
    {
        $kontrakModel = new KontrakModel();
        if ($kontrakModel->delete($id)) {
            return redirect()->to(base_url('kontrak'))->with('success', 'Kontrak pekerjaan berhasil dihapus!');
        }
        return redirect()->to(base_url('kontrak'))->with('error', 'Gagal menghapus kontrak.');
    }

    // ==========================================
    // PEJABAT PPK CRUD
    // ==========================================
    public function ppk(): string
    {
        $ppkModel = new PpkModel();
        $db = \Config\Database::connect();

        $ppks = $ppkModel->findAll();
        $units = $db->table('ref_unit')->get()->getResultArray();

        return view('admin/kontrak/ppk', [
            'ppks'  => $ppks,
            'units' => $units
        ]);
    }

    public function ppk_store()
    {
        $ppkModel = new PpkModel();
        $db = \Config\Database::connect();

        $unit_id = $this->request->getPost('unit_id');
        $unit = $db->table('ref_unit')->where('unit_id', $unit_id)->get()->getRowArray();
        $opd = $unit ? $unit['unit_nama'] : '';

        $data = [
            'nip'     => $this->request->getPost('nip'),
            'nama'    => $this->request->getPost('nama'),
            'jabatan' => $this->request->getPost('jabatan'),
            'unit_id' => $unit_id,
            'opd'     => $opd,
            'tahun'   => $this->request->getPost('tahun') ?? date('Y'),
        ];

        if ($ppkModel->save($data)) {
            return redirect()->to(base_url('kontrak/ppk'))->with('success', 'Pejabat PPK berhasil ditambahkan!');
        } else {
            return redirect()->to(base_url('kontrak/ppk'))->with('error', 'Gagal menambahkan Pejabat PPK. Pastikan NIP unik dan 18 digit.');
        }
    }

    public function ppk_delete($id)
    {
        $ppkModel = new PpkModel();
        if ($ppkModel->delete($id)) {
            return redirect()->to(base_url('kontrak/ppk'))->with('success', 'Pejabat PPK berhasil dihapus!');
        }
        return redirect()->to(base_url('kontrak/ppk'))->with('error', 'Gagal menghapus Pejabat PPK.');
    }

    // ==========================================
    // PAKET PROYEK CRUD
    // ==========================================
    public function paket(): string
    {
        $paketModel = new PaketModel();
        $db = \Config\Database::connect();

        $pakets = $paketModel->select('paket_data.*, ref_unit.unit_nama')
                             ->join('ref_unit', 'ref_unit.unit_id = paket_data.unit_id', 'left')
                             ->findAll();

        $units = $db->table('ref_unit')->get()->getResultArray();
        $jenis_kontrak = $db->table('kontrak_jenis')->get()->getResultArray();
        $metode_pengadaan = $db->table('ref_metode_pengadaan')->get()->getResultArray();

        return view('admin/kontrak/paket', [
            'pakets'            => $pakets,
            'units'             => $units,
            'jenis_kontrak'     => $jenis_kontrak,
            'metode_pengadaan'  => $metode_pengadaan
        ]);
    }

    public function paket_store()
    {
        $paketModel = new PaketModel();

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
            'no_hp_email'     => $this->request->getPost('no_hp_email') ?? '',
            'tahun'           => $this->request->getPost('tahun') ?? date('Y'),
        ];

        if ($paketModel->save($data)) {
            return redirect()->to(base_url('kontrak/paket'))->with('success', 'Paket pekerjaan berhasil ditambahkan!');
        } else {
            return redirect()->to(base_url('kontrak/paket'))->with('error', 'Gagal menambahkan paket pekerjaan.');
        }
    }

    public function paket_delete($id)
    {
        $paketModel = new PaketModel();
        if ($paketModel->delete($id)) {
            return redirect()->to(base_url('kontrak/paket'))->with('success', 'Paket pekerjaan berhasil dihapus!');
        }
        return redirect()->to(base_url('kontrak/paket'))->with('error', 'Gagal menghapus paket pekerjaan.');
    }
}

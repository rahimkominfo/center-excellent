<?php

namespace App\Controllers;

use App\Models\AspekKinerjaModel;
use App\Models\IndikatorKinerjaModel;

class Penilaian extends BaseController
{
    public function index(): string
    {
        return view('admin/penilaian/index');
    }

    // ==========================================
    // ASPEK KINERJA CRUD
    // ==========================================
    public function aspek_kinerja(): string
    {
        $aspekModel = new AspekKinerjaModel();
        $db = \Config\Database::connect();

        $kj_id = $this->request->getGet('kj_id') ?? 1;

        $aspeks = $aspekModel->where('kj_id', $kj_id)->findAll();
        $jenis_kontrak = $db->table('kontrak_jenis')->get()->getResultArray();

        return view('admin/penilaian/aspek_kinerja', [
            'aspeks'        => $aspeks,
            'jenis_kontrak' => $jenis_kontrak,
            'selected_kj'   => $kj_id
        ]);
    }

    public function aspek_store()
    {
        $aspekModel = new AspekKinerjaModel();

        $kj_id = $this->request->getPost('kj_id');
        $data = [
            'kj_id'            => $kj_id,
            'nm_aspek_kinerja' => $this->request->getPost('nm_aspek_kinerja'),
            'bobot'            => $this->request->getPost('bobot') ?? 0,
        ];

        if ($aspekModel->save($data)) {
            return redirect()->to(base_url('penilaian/aspek_kinerja?kj_id=' . $kj_id))->with('success', 'Aspek kinerja berhasil ditambahkan!');
        }
        return redirect()->to(base_url('penilaian/aspek_kinerja?kj_id=' . $kj_id))->with('error', 'Gagal menambahkan aspek kinerja.');
    }

    public function aspek_delete($id)
    {
        $aspekModel = new AspekKinerjaModel();
        $aspek = $aspekModel->find($id);
        $kj_id = $aspek ? $aspek['kj_id'] : 1;

        if ($aspekModel->delete($id)) {
            return redirect()->to(base_url('penilaian/aspek_kinerja?kj_id=' . $kj_id))->with('success', 'Aspek kinerja berhasil dihapus!');
        }
        return redirect()->to(base_url('penilaian/aspek_kinerja?kj_id=' . $kj_id))->with('error', 'Gagal menghapus aspek kinerja.');
    }

    public function aspek_update_bobot()
    {
        $aspekModel = new AspekKinerjaModel();
        $kj_id = $this->request->getPost('kj_id');
        $bobots = $this->request->getPost('bobot'); // Array: [id => bobot]

        if ($bobots) {
            foreach ($bobots as $id => $bobot) {
                $aspekModel->update($id, ['bobot' => $bobot]);
            }
            return redirect()->to(base_url('penilaian/aspek_kinerja?kj_id=' . $kj_id))->with('success', 'Bobot aspek kinerja berhasil diperbarui!');
        }
        return redirect()->to(base_url('penilaian/aspek_kinerja?kj_id=' . $kj_id))->with('error', 'Tidak ada data bobot untuk diperbarui.');
    }

    // ==========================================
    // INDIKATOR KINERJA CRUD
    // ==========================================
    public function indikator_kinerja(): string
    {
        $indikatorModel = new IndikatorKinerjaModel();
        $aspekModel = new AspekKinerjaModel();
        $db = \Config\Database::connect();

        $kj_id = $this->request->getGet('kj_id') ?? 1;

        // Fetch indicators belonging to aspects of the selected contract type (kj_id)
        $indikators = $indikatorModel->select('indikator_kinerja.*, aspek_kinerja.nm_aspek_kinerja')
                                     ->join('aspek_kinerja', 'aspek_kinerja.kd_aspek_kinerja = indikator_kinerja.kd_aspek_kinerja')
                                     ->where('aspek_kinerja.kj_id', $kj_id)
                                     ->findAll();

        $aspeks = $aspekModel->where('kj_id', $kj_id)->findAll();
        $jenis_kontrak = $db->table('kontrak_jenis')->get()->getResultArray();

        return view('admin/penilaian/indikator_kinerja', [
            'indikators'    => $indikators,
            'aspeks'        => $aspeks,
            'jenis_kontrak' => $jenis_kontrak,
            'selected_kj'   => $kj_id
        ]);
    }

    public function indikator_store()
    {
        $indikatorModel = new IndikatorKinerjaModel();
        $aspekModel = new AspekKinerjaModel();

        $kd_aspek = $this->request->getPost('kd_aspek_kinerja');
        $aspek = $aspekModel->find($kd_aspek);
        $kj_id = $aspek ? $aspek['kj_id'] : 1;

        $data = [
            'kd_aspek_kinerja' => $kd_aspek,
            'nm_indikator'     => $this->request->getPost('nm_indikator'),
            'bobot_indikator'  => $this->request->getPost('bobot_indikator') ?? 0,
        ];

        if ($indikatorModel->save($data)) {
            return redirect()->to(base_url('penilaian/indikator_kinerja?kj_id=' . $kj_id))->with('success', 'Indikator kinerja berhasil ditambahkan!');
        }
        return redirect()->to(base_url('penilaian/indikator_kinerja?kj_id=' . $kj_id))->with('error', 'Gagal menambahkan indikator kinerja.');
    }

    public function indikator_delete($id)
    {
        $indikatorModel = new IndikatorKinerjaModel();
        $aspekModel = new AspekKinerjaModel();
        
        $indikator = $indikatorModel->find($id);
        $aspek = $indikator ? $aspekModel->find($indikator['kd_aspek_kinerja']) : null;
        $kj_id = $aspek ? $aspek['kj_id'] : 1;

        if ($indikatorModel->delete($id)) {
            return redirect()->to(base_url('penilaian/indikator_kinerja?kj_id=' . $kj_id))->with('success', 'Indikator kinerja berhasil dihapus!');
        }
        return redirect()->to(base_url('penilaian/indikator_kinerja?kj_id=' . $kj_id))->with('error', 'Gagal menghapus indikator kinerja.');
    }

    public function indikator_update_bobot()
    {
        $indikatorModel = new IndikatorKinerjaModel();
        $kj_id = $this->request->getPost('kj_id');
        $bobots = $this->request->getPost('bobot'); // Array: [id => bobot]

        if ($bobots) {
            foreach ($bobots as $id => $bobot) {
                $indikatorModel->update($id, ['bobot_indikator' => $bobot]);
            }
            return redirect()->to(base_url('penilaian/indikator_kinerja?kj_id=' . $kj_id))->with('success', 'Bobot indikator kinerja berhasil diperbarui!');
        }
        return redirect()->to(base_url('penilaian/indikator_kinerja?kj_id=' . $kj_id))->with('error', 'Tidak ada data bobot untuk diperbarui.');
    }
}

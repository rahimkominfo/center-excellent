<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('title') ?>Daftar Paket Proyek<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Breadcrumbs -->
<nav class="flex text-slate-500 text-sm mb-6" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-2">
        <li class="inline-flex items-center">
            <a href="<?= base_url('dashboard') ?>" class="hover:text-emerald-600 inline-flex items-center gap-1.5 font-medium transition">
                <i class="fas fa-home text-xs"></i> Dashboard
            </a>
        </li>
        <li>
            <div class="flex items-center">
                <i class="fas fa-chevron-right text-xs text-slate-300 mr-2"></i>
                <span class="text-slate-400 font-medium">Data Paket</span>
            </div>
        </li>
    </ol>
</nav>

<!-- Alert notifications -->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-3">
        <i class="fas fa-check-circle text-lg"></i>
        <span class="text-sm font-semibold"><?= session()->getFlashdata('success') ?></span>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl flex items-center gap-3">
        <i class="fas fa-exclamation-circle text-lg"></i>
        <span class="text-sm font-semibold"><?= session()->getFlashdata('error') ?></span>
    </div>
<?php endif; ?>

<!-- Page Header Card -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div class="flex items-center gap-4">
        <button onclick="goBack()" class="bg-slate-100 hover:bg-slate-200 text-slate-700 w-10 h-10 rounded-xl flex items-center justify-center transition" title="Kembali">
            <i class="fas fa-arrow-left"></i>
        </button>
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Manajemen Paket Pengadaan</h2>
            <p class="text-sm text-slate-500 mt-1">Registrasi dan perbaharui data paket tender atau e-purchasing</p>
        </div>
    </div>
    <div>
        <button onclick="openModal('modal-tambah-paket')" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2 px-4 rounded-xl text-sm transition duration-150 flex items-center gap-2 shadow-lg shadow-emerald-600/10">
            <i class="fas fa-plus"></i> Tambah Paket
        </button>
    </div>
</div>

<!-- Table Card Container -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex flex-wrap items-center justify-between gap-4">
        <h3 class="font-bold text-slate-800">Daftar Paket Pengadaan Barang/Jasa</h3>
    </div>
    
    <div class="overflow-x-auto custom-scrollbar">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 font-semibold uppercase tracking-wider text-xs">
                    <th class="px-6 py-4 text-center w-16">No.</th>
                    <th class="px-6 py-4">Nama OPD Instansi</th>
                    <th class="px-6 py-4">Nama Paket Pekerjaan</th>
                    <th class="px-6 py-4 text-right">Nilai Pagu (Rp)</th>
                    <th class="px-6 py-4 text-right">Nilai HPS (Rp)</th>
                    <th class="px-6 py-4 text-right">Nilai Kontrak (Rp)</th>
                    <th class="px-6 py-4 text-center">Tahun</th>
                    <th class="px-6 py-4 text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-slate-700">
                <?php if (empty($pakets)) : ?>
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-slate-500">Belum ada paket pekerjaan yang terdaftar.</td>
                    </tr>
                <?php else : ?>
                    <?php $no = 1; foreach ($pakets as $paket) : ?>
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-6 py-4 text-center font-medium"><?= $no++ ?>.</td>
                            <td class="px-6 py-4 font-medium text-slate-800"><?= esc($paket['unit_nama']) ?></td>
                            <td class="px-6 py-4 font-semibold text-slate-900"><?= esc($paket['nm_paket']) ?></td>
                            <td class="px-6 py-4 text-right"><?= number_format($paket['pagu'], 0, ',', '.') ?></td>
                            <td class="px-6 py-4 text-right"><?= number_format($paket['nilai_hps'], 0, ',', '.') ?></td>
                            <td class="px-6 py-4 text-right font-medium text-emerald-600"><?= number_format($paket['nilai_kontrak'], 0, ',', '.') ?></td>
                            <td class="px-6 py-4 text-center"><?= esc($paket['tahun']) ?></td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-3">
                                    <a href="<?= base_url('kontrak/paket/delete/' . $paket['paket_id']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus paket ini?')" class="text-slate-400 hover:text-rose-600 transition" title="Hapus"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Paket -->
<div id="modal-tambah-paket" class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl border border-slate-100 w-full max-w-2xl shadow-2xl overflow-hidden flex flex-col animate-in zoom-in-95 duration-200">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
            <h3 class="font-bold text-slate-800 text-lg">Tambah Paket Baru</h3>
            <button onclick="closeModal('modal-tambah-paket')" class="text-slate-400 hover:text-slate-600 focus:outline-none"><i class="fas fa-times text-lg"></i></button>
        </div>
        <form class="p-6 space-y-4 max-h-[80vh] overflow-y-auto custom-scrollbar" action="<?= base_url('kontrak/paket/store') ?>" method="POST">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Pilih OPD Instansi</label>
                    <select name="unit_id" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" required>
                        <option value="">-- Pilih OPD --</option>
                        <?php foreach ($units as $unit) : ?>
                            <option value="<?= $unit['unit_id'] ?>"><?= $unit['unit_nama'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Jenis Kontrak</label>
                    <select name="kj_id" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" required>
                        <option value="">-- Pilih Jenis --</option>
                        <?php foreach ($jenis_kontrak as $jk) : ?>
                            <option value="<?= $jk['kj_id'] ?>"><?= $jk['nm_jenis_kontrak'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Metode Pengadaan</label>
                    <select name="kd_mp" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" required>
                        <option value="">-- Pilih Metode --</option>
                        <?php foreach ($metode_pengadaan as $mp) : ?>
                            <option value="<?= $mp['kd_mp'] ?>"><?= $mp['nm_mp'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Kode RUP</label>
                    <input name="kode_rup" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="number" placeholder="Masukkan Kode RUP..." required>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Nama Paket</label>
                <input name="nm_paket" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" placeholder="Nama lengkap paket..." required>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Nilai Pagu</label>
                    <input name="pagu" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" placeholder="Nilai Pagu..." required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Nilai HPS</label>
                    <input name="nilai_hps" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" placeholder="Nilai HPS..." required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Nilai Kontrak</label>
                    <input name="nilai_kontrak" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" placeholder="Nilai Kontrak..." required>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Nama Pemenang Kontraktor</label>
                    <input name="nm_pemenang" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" placeholder="Nama PT/CV..." required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Alamat Pemenang</label>
                    <input name="alamat_pemenang" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" placeholder="Alamat lengkap..." required>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Nomor HP/Email</label>
                    <input name="no_hp_email" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" placeholder="Kontak..." required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Tahun Anggaran</label>
                    <input name="tahun" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" value="<?= date('Y') ?>" required>
                </div>
            </div>
            
            <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-tambah-paket')" class="px-4 py-2 border border-slate-200 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 transition">Batal</button>
                <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-sm font-semibold transition shadow-md shadow-emerald-600/10">Tambah</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    }
    function closeModal(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }
</script>
<?= $this->endSection() ?>

<?= $this->extend('dashboard/layouts/main') ?>

<?= $this->section('title') ?>Edit Paket Proyek<?= $this->endSection() ?>

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
            <a href="<?= base_url('dashboard/kontrak_ppk') ?>" class="hover:text-emerald-600 flex items-center font-medium transition">
                <i class="fas fa-chevron-right text-xs text-slate-300 mr-2"></i> kontrak_ppk
            </a>
        </li>
        <li>
            <div class="flex items-center">
                <i class="fas fa-chevron-right text-xs text-slate-300 mr-2"></i>
                <span class="text-slate-400 font-medium">Edit Paket</span>
            </div>
        </li>
    </ol>
</nav>

<!-- Form Card Container -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm max-w-3xl mx-auto overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-4">
        <button onclick="goBack()" class="bg-slate-100 hover:bg-slate-200 text-slate-700 w-8 h-8 rounded-lg flex items-center justify-center transition" title="Kembali">
            <i class="fas fa-arrow-left text-xs"></i>
        </button>
        <div>
            <h3 class="font-bold text-slate-800 text-lg">Edit Paket Pengadaan</h3>
            <p class="text-xs text-slate-500"><?= esc($paket['nm_paket']) ?></p>
        </div>
    </div>
    
    <form class="p-6 space-y-4" action="<?= base_url('dashboard/form_edit_paket/update') ?>" method="POST">
        <input type="hidden" name="paket_id" value="<?= esc($paket['paket_id']) ?>">

        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <label class="md:col-span-3 text-sm font-semibold text-slate-600 md:text-right pr-4">OPD / Unit Kerja</label>
            <div class="md:col-span-9">
                <select name="unit_id" class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" required>
                    <?php foreach ($units as $unit) : ?>
                        <option value="<?= $unit['unit_id'] ?>" <?= ($unit['unit_id'] == $paket['unit_id']) ? 'selected' : '' ?>><?= esc($unit['unit_nama']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <label class="md:col-span-3 text-sm font-semibold text-slate-600 md:text-right pr-4">Jenis Kontrak</label>
            <div class="md:col-span-9">
                <select name="kj_id" class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" required>
                    <?php foreach ($jenis_kontrak as $jk) : ?>
                        <option value="<?= $jk['kj_id'] ?>" <?= ($jk['kj_id'] == $paket['kj_id']) ? 'selected' : '' ?>><?= esc($jk['nm_jenis_kontrak']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <label class="md:col-span-3 text-sm font-semibold text-slate-600 md:text-right pr-4">Metode Pengadaan</label>
            <div class="md:col-span-9">
                <select name="kd_mp" class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" required>
                    <?php foreach ($metode_pengadaan as $mp) : ?>
                        <option value="<?= $mp['kd_mp'] ?>" <?= ($mp['kd_mp'] == $paket['kd_mp']) ? 'selected' : '' ?>><?= esc($mp['nm_mp']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <label class="md:col-span-3 text-sm font-semibold text-slate-600 md:text-right pr-4">Nama Paket</label>
            <div class="md:col-span-9">
                <textarea class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" name="nm_paket" rows="3" required><?= esc($paket['nm_paket']) ?></textarea>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <label class="md:col-span-3 text-sm font-semibold text-slate-600 md:text-right pr-4">Kode RUP</label>
            <div class="md:col-span-9">
                <input class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="number" name="kode_rup" value="<?= esc($paket['kode_rup']) ?>" required>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <label class="md:col-span-3 text-sm font-semibold text-slate-600 md:text-right pr-4">Pagu Anggaran</label>
            <div class="md:col-span-9">
                <input class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" name="pagu" value="<?= number_format($paket['pagu'], 0, ',', '.') ?>" required>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <label class="md:col-span-3 text-sm font-semibold text-slate-600 md:text-right pr-4">Nilai HPS</label>
            <div class="md:col-span-9">
                <input class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" name="nilai_hps" value="<?= number_format($paket['nilai_hps'], 0, ',', '.') ?>" required>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <label class="md:col-span-3 text-sm font-semibold text-slate-600 md:text-right pr-4">Nilai Kontrak</label>
            <div class="md:col-span-9">
                <input class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" name="nilai_kontrak" value="<?= number_format($paket['nilai_kontrak'], 0, ',', '.') ?>" required>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <label class="md:col-span-3 text-sm font-semibold text-slate-600 md:text-right pr-4">Nama Pemenang</label>
            <div class="md:col-span-9">
                <input class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" name="nm_pemenang" value="<?= esc($paket['nm_pemenang']) ?>" required>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <label class="md:col-span-3 text-sm font-semibold text-slate-600 md:text-right pr-4">Alamat Pemenang</label>
            <div class="md:col-span-9">
                <input class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" name="alamat_pemenang" value="<?= esc($paket['alamat_pemenang']) ?>" required>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <label class="md:col-span-3 text-sm font-semibold text-slate-600 md:text-right pr-4">HP / Email Pemenang</label>
            <div class="md:col-span-9">
                <input class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" name="no_hp_email" value="<?= esc($paket['no_hp_email']) ?>">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <label class="md:col-span-3 text-sm font-semibold text-slate-600 md:text-right pr-4">Tahun Anggaran</label>
            <div class="md:col-span-9">
                <input class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" name="tahun" value="<?= esc($paket['tahun']) ?>" required>
            </div>
        </div>
        
        <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
            <button type="button" onclick="goBack()" class="px-4 py-2 border border-slate-200 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 transition">Batal</button>
            <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-sm font-semibold transition shadow-md shadow-emerald-600/10">Simpan Perubahan</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>

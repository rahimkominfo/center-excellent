<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('title') ?>Kelola Kontrak Pekerjaan<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Page Header Card -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-8 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div>
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Kelola Kontrak Pekerjaan</h2>
        <p class="text-sm text-slate-500 mt-1">Tambah, petakan pejabat PPK pada paket proyek pengadaan, dan lihat daftar kontrak aktif</p>
    </div>
</div>

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

<!-- Form Card Container -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-8">
    <h3 class="font-bold text-slate-800 text-base border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
        <i class="fas fa-file-signature text-emerald-500"></i> Petakan / Tambah Kontrak Baru
    </h3>
    
    <form class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end" action="<?= base_url('kontrak/store') ?>" method="POST">
        <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Pilih Paket Pekerjaan</label>
            <select name="paket_id" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" required>
                <option value="">-- Pilih Paket --</option>
                <?php foreach ($pakets as $paket) : ?>
                    <option value="<?= $paket['paket_id'] ?>"><?= esc($paket['nm_paket']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Pilih Pejabat PPK</label>
            <select name="nip" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" required>
                <option value="">-- Pilih Pejabat PPK --</option>
                <?php foreach ($ppks as $ppk) : ?>
                    <option value="<?= $ppk['nip'] ?>"><?= esc($ppk['nama']) ?> (NIP. <?= esc($ppk['nip']) ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Sumber Anggaran</label>
            <input name="sumber_anggaran" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" placeholder="APBD / DAK / DAU..." required>
        </div>
        
        <div>
            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2 px-4 rounded-xl text-sm transition duration-150 shadow-md shadow-emerald-600/10 flex items-center justify-center gap-2">
                <i class="fas fa-plus"></i> Tambah Kontrak
            </button>
        </div>
    </form>
</div>

<!-- Table Card Container -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex flex-wrap items-center justify-between gap-4">
        <h3 class="font-bold text-slate-800">Daftar Kontrak Yang Terdaftar</h3>
    </div>
    
    <div class="overflow-x-auto custom-scrollbar">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 font-semibold uppercase tracking-wider text-xs">
                    <th class="px-6 py-4 text-center w-16">No.</th>
                    <th class="px-6 py-4">Nama Pejabat PPK / NIP</th>
                    <th class="px-6 py-4">Nama Paket Pekerjaan</th>
                    <th class="px-6 py-4">Sumber Anggaran</th>
                    <th class="px-6 py-4 text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-slate-700">
                <?php if (empty($kontraks)) : ?>
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-slate-500">Belum ada kontrak yang dipetakan.</td>
                    </tr>
                <?php else : ?>
                    <?php $no = 1; foreach ($kontraks as $kontrak) : ?>
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-6 py-4 text-center font-medium"><?= $no++ ?>.</td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-slate-900 block"><?= esc($kontrak['ppk_nama'] ?? 'NIP: ' . $kontrak['nip']) ?></span>
                                <span class="text-xs text-slate-500 font-mono">NIP. <?= esc($kontrak['nip']) ?></span>
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-800"><?= esc($kontrak['nm_paket'] ?? 'Paket ID: ' . $kontrak['paket_id']) ?></td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-emerald-700 text-xs bg-emerald-50 inline-block px-2.5 py-1 rounded-lg border border-emerald-100"><?= esc($kontrak['sumber_anggaran']) ?></span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="<?= base_url('kontrak/delete/' . $kontrak['kontrak_id']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus kontrak ini?')" class="text-slate-400 hover:text-rose-600 p-2 transition inline-block" title="Hapus"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>

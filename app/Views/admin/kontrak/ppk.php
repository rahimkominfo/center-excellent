<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('title') ?>Daftar Pejabat PPK<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Page Header Card -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-8 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div class="flex items-center gap-4">
        <button onclick="goBack()" class="bg-slate-100 hover:bg-slate-200 text-slate-700 w-10 h-10 rounded-xl flex items-center justify-center transition" title="Kembali">
            <i class="fas fa-arrow-left"></i>
        </button>
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Daftar Pejabat Pembuat Komitmen (PPK)</h2>
            <p class="text-sm text-slate-500 mt-1">Registrasi dan perbaharui pejabat PPK yang terdaftar di lingkungan Pemda</p>
        </div>
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

<!-- Register Form -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-8">
    <h3 class="font-bold text-slate-800 text-base border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
        <i class="fas fa-user-plus text-emerald-500"></i> Registrasi Pejabat PPK Baru
    </h3>
    
    <form class="grid grid-cols-1 md:grid-cols-3 gap-4" action="<?= base_url('kontrak/ppk/store') ?>" method="POST">
        <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Nomor Induk Pegawai (NIP)</label>
            <input name="nip" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" placeholder="Masukkan 18 digit NIP..." required pattern="\d{18}">
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Nama Lengkap</label>
            <input name="nama" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" placeholder="Nama Lengkap dengan Gelar..." required>
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Jabatan Struktural</label>
            <input name="jabatan" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" placeholder="E.g. Kepala Bidang..." required>
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">OPD Instansi</label>
            <select name="unit_id" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" required>
                <option value="">-- Pilih OPD --</option>
                <?php foreach ($units as $unit) : ?>
                    <option value="<?= $unit['unit_id'] ?>"><?= $unit['unit_nama'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Tahun Tugas</label>
            <input name="tahun" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" value="<?= date('Y') ?>" required>
        </div>
        <div class="flex items-end">
            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2 px-4 rounded-xl text-sm transition duration-150 shadow-md shadow-emerald-600/10 flex items-center justify-center gap-2">
                <i class="fas fa-plus"></i> Tambah PPK
            </button>
        </div>
    </form>
</div>

<!-- Table Card Container -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex flex-wrap items-center justify-between gap-4">
        <h3 class="font-bold text-slate-800">Daftar PPK Aktif</h3>
    </div>
    
    <div class="overflow-x-auto custom-scrollbar">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 font-semibold uppercase tracking-wider text-xs">
                    <th class="px-6 py-4 w-44">NIP Pejabat</th>
                    <th class="px-6 py-4">Nama Lengkap</th>
                    <th class="px-6 py-4">Jabatan Struktural</th>
                    <th class="px-6 py-4">OPD Instansi</th>
                    <th class="px-6 py-4 text-center w-24">Tahun Tugas</th>
                    <th class="px-6 py-4 text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-slate-700">
                <?php if (empty($ppks)) : ?>
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-slate-500">Belum ada pejabat PPK yang terdaftar.</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($ppks as $ppk) : ?>
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-6 py-4 font-mono font-semibold text-slate-900"><?= esc($ppk['nip']) ?></td>
                            <td class="px-6 py-4 font-semibold"><?= esc($ppk['nama']) ?></td>
                            <td class="px-6 py-4"><?= esc($ppk['jabatan']) ?></td>
                            <td class="px-6 py-4 font-medium text-slate-800"><?= esc($ppk['opd']) ?></td>
                            <td class="px-6 py-4 text-center font-medium"><?= esc($ppk['tahun']) ?></td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-3">
                                    <a href="<?= base_url('kontrak/ppk/delete/' . $ppk['ppk_id']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus pejabat PPK ini?')" class="text-slate-400 hover:text-rose-600 transition" title="Hapus"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>

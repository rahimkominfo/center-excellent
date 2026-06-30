<?= $this->extend('dashboard/layouts/main') ?>

<?= $this->section('title') ?>Kelola Berkas SP2D<?= $this->endSection() ?>

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
                <i class="fas fa-chevron-right text-xs text-slate-300 mr-2"></i> Laporan Monitoring
            </a>
        </li>
        <li>
            <div class="flex items-center">
                <i class="fas fa-chevron-right text-xs text-slate-300 mr-2"></i>
                <span class="text-slate-400 font-medium">SP2D</span>
            </div>
        </li>
    </ol>
</nav>

<!-- Page Header Card -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">SP2D Pekerjaan Kontrak</h2>
        <p class="text-sm text-slate-500 mt-1">Paket: <?= esc($kontrak['nm_paket']) ?></p>
    </div>
    <div>
        <button onclick="openModal('modal-sp2d')" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2 px-4 rounded-xl text-sm transition duration-150 flex items-center gap-2 shadow-lg shadow-emerald-600/10">
            <i class="fas fa-plus"></i> Tambah SP2D
        </button>
    </div>
</div>

<!-- Alert notifications -->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-3">
        <i class="fas fa-check-circle text-lg"></i>
        <span class="text-sm font-semibold"><?= session()->getFlashdata('success') ?></span>
    </div>
<?php endif; ?>

<!-- Table Card Container -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto custom-scrollbar">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 font-semibold uppercase tracking-wider text-xs">
                    <th class="px-6 py-4 text-center w-16">No.</th>
                    <th class="px-6 py-4">Nomor SP2D</th>
                    <th class="px-6 py-4 text-center">Tanggal SP2D</th>
                    <th class="px-6 py-4 text-right">Nilai SP2D (Rp)</th>
                    <th class="px-6 py-4 text-center">Berkas File</th>
                    <th class="px-6 py-4 text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-slate-700">
                <?php if (empty($sp2ds)) : ?>
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-slate-500">Belum ada dokumen SP2D yang diupload.</td>
                    </tr>
                <?php else : ?>
                    <?php $no = 1; foreach ($sp2ds as $sp2d) : ?>
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-6 py-4 text-center font-medium"><?= $no++ ?>.</td>
                            <td class="px-6 py-4 font-semibold text-slate-900"><?= esc($sp2d['no_sp2d']) ?></td>
                            <td class="px-6 py-4 text-center"><?= date('d-m-Y', strtotime($sp2d['tgl_sp2d'])) ?></td>
                            <td class="px-6 py-4 text-right font-medium text-slate-800"><?= number_format($sp2d['nilai_sp2d'], 0, ',', '.') ?></td>
                            <td class="px-6 py-4 text-center">
                                <?php if (!empty($sp2d['file'])) : ?>
                                    <a href="<?= base_url('uploads/' . $sp2d['file']) ?>" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-xs font-semibold hover:bg-slate-200 border border-slate-200 transition">
                                        <i class="fas fa-file-pdf"></i> Lihat Berkas
                                    </a>
                                <?php else : ?>
                                    <span class="text-xs text-slate-400">Tidak ada berkas</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="<?= base_url('dashboard/sp2d/delete/' . $sp2d['sp2d_id']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus dokumen SP2D ini?')" class="text-slate-400 hover:text-rose-600 transition" title="Hapus"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah SP2D -->
<div id="modal-sp2d" class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl border border-slate-100 w-full max-w-lg shadow-2xl overflow-hidden flex flex-col animate-in zoom-in-95 duration-200">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
            <h3 class="font-bold text-slate-800 text-lg">Tambah SP2D</h3>
            <button onclick="closeModal('modal-sp2d')" class="text-slate-400 hover:text-slate-600 focus:outline-none"><i class="fas fa-times text-lg"></i></button>
        </div>
        <form class="p-6 space-y-4" action="<?= base_url('dashboard/sp2d/store') ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="kontrak_id" value="<?= esc($kontrak['kontrak_id']) ?>">
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Nomor SP2D</label>
                <input name="no_sp2d" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" placeholder="Masukkan nomor SP2D..." required>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Tanggal SP2D</label>
                    <input name="tgl_sp2d" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="date" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Nilai SP2D</label>
                    <input name="nilai_sp2d" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" placeholder="Nilai rupiah..." required>
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Upload Berkas Pendukung</label>
                <input name="file" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition bg-white" type="file" required>
            </div>
            <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-sp2d')" class="px-4 py-2 border border-slate-200 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 transition">Batal</button>
                <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-sm font-semibold transition">Tambah</button>
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

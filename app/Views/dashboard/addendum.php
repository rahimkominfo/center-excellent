<?= $this->extend('dashboard/layouts/main') ?>

<?= $this->section('title') ?>Kelola Addendum Kontrak<?= $this->endSection() ?>

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
                <span class="text-slate-400 font-medium">Addendum</span>
            </div>
        </li>
    </ol>
</nav>

<!-- Page Header Card -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Addendum Kontrak Pekerjaan</h2>
        <p class="text-sm text-slate-500 mt-1">Paket: <?= esc($kontrak['nm_paket']) ?></p>
    </div>
    <div>
        <button onclick="openModal('modal-addendum')" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2 px-4 rounded-xl text-sm transition duration-150 flex items-center gap-2 shadow-lg shadow-emerald-600/10">
            <i class="fas fa-plus"></i> Tambah Addendum
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
                    <th class="px-6 py-4 text-center align-middle" rowspan="2">No.</th>
                    <th class="px-6 py-4 align-middle" rowspan="2">Nomor Addendum</th>
                    <th class="px-6 py-4 align-middle" rowspan="2">Tanggal</th>
                    <th class="px-6 py-4 text-right align-middle" rowspan="2">Nilai (Rp)</th>
                    <th class="px-6 py-4 align-middle" rowspan="2">Jaminan</th>
                    <th class="px-6 py-4 text-center align-middle" colspan="2">Pelaksanaan</th>
                    <th class="px-6 py-4 text-center align-middle" rowspan="2">Pemeliharaan Jangka Waktu</th>
                    <th class="px-6 py-4 text-center align-middle" rowspan="2">Aksi</th>
                </tr>
                <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 font-semibold uppercase tracking-wider text-[10px]">
                    <th class="px-6 py-3 text-center align-middle">Mulai</th>
                    <th class="px-6 py-3 text-center align-middle">Akhir</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-slate-700">
                <?php if (empty($addendums)) : ?>
                    <tr>
                        <td colspan="9" class="px-6 py-4 text-center text-slate-500">Belum ada addendum kontrak yang terdaftar.</td>
                    </tr>
                <?php else : ?>
                    <?php $no = 1; foreach ($addendums as $addendum) : ?>
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-6 py-4 text-center font-medium"><?= $no++ ?>.</td>
                            <td class="px-6 py-4 font-semibold text-slate-900"><?= esc($addendum['no_addendum']) ?></td>
                            <td class="px-6 py-4"><?= date('d-m-Y', strtotime($addendum['tgl_addendum'])) ?></td>
                            <td class="px-6 py-4 text-right font-medium text-slate-800"><?= number_format($addendum['nilai_addendum'], 0, ',', '.') ?></td>
                            <td class="px-6 py-4"><?= esc($addendum['jaminan_addendum']) ?></td>
                            <td class="px-6 py-4 text-center text-xs"><?= date('d M Y', strtotime($addendum['tgl_mulai_addendum'])) ?></td>
                            <td class="px-6 py-4 text-center text-xs"><?= date('d M Y', strtotime($addendum['tgl_akhir_addendum'])) ?></td>
                            <td class="px-6 py-4 text-center font-medium"><?= esc($addendum['wp_addendum']) ?> hari</td>
                            <td class="px-6 py-4 text-center">
                                <a href="<?= base_url('dashboard/addendum/delete/' . $addendum['addendum_id']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus addendum ini?')" class="text-slate-400 hover:text-rose-600 transition" title="Hapus"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Addendum -->
<div id="modal-addendum" class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl border border-slate-100 w-full max-w-lg shadow-2xl overflow-hidden flex flex-col animate-in zoom-in-95 duration-200">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
            <h3 class="font-bold text-slate-800 text-lg">Tambah Addendum</h3>
            <button onclick="closeModal('modal-addendum')" class="text-slate-400 hover:text-slate-600 focus:outline-none"><i class="fas fa-times text-lg"></i></button>
        </div>
        <form class="p-6 space-y-4" action="<?= base_url('dashboard/addendum/store') ?>" method="POST">
            <input type="hidden" name="kontrak_id" value="<?= esc($kontrak['kontrak_id']) ?>">
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Nomor Addendum</label>
                <input name="no_addendum" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" placeholder="Masukkan nomor addendum..." required>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Tanggal Addendum</label>
                    <input name="tgl_addendum" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="date" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Nilai Addendum (Rp)</label>
                    <input name="nilai_addendum" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" placeholder="E.g. 12.100.000.000" required>
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Jaminan</label>
                <input name="jaminan_addendum" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" placeholder="Nama Bank/Jaminan..." required>
            </div>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Tgl Mulai</label>
                    <input name="tgl_mulai_addendum" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="date" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Tgl Akhir</label>
                    <input name="tgl_akhir_addendum" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="date" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">WP Pemeliharaan</label>
                    <input name="wp_addendum" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="number" placeholder="Hari..." required>
                </div>
            </div>
            <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-addendum')" class="px-4 py-2 border border-slate-200 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 transition">Batal</button>
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

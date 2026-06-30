<?= $this->extend('dashboard/layouts/main') ?>

<?= $this->section('title') ?>Daftar Kontrak Pejabat PPK<?= $this->endSection() ?>

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
                <span class="text-slate-400 font-medium">Kontrak PPK / Penilaian</span>
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

<!-- Page Header Card -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Penilaian Kinerja Vendor Paket Pengadaan Barang/Jasa</h2>
        <p class="text-sm text-slate-500 mt-1">Bagian Pengadaan Barang/Jasa Pemerintah Daerah Kabupaten Sinjai</p>
    </div>
</div>

<!-- Table Card Container -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex flex-wrap items-center justify-between gap-4">
        <h3 class="font-bold text-slate-800">Daftar Paket Kontrak</h3>
        <form class="relative" method="GET" action="<?= base_url('dashboard/kontrak_ppk') ?>">
            <input name="search" class="w-64 pl-9 pr-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition placeholder-slate-400" type="search" placeholder="Cari paket..." value="<?= esc($search) ?>">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                <i class="fas fa-search text-xs"></i>
            </div>
        </form>
    </div>
    
    <div class="overflow-x-auto custom-scrollbar">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 font-semibold uppercase tracking-wider text-xs">
                    <th class="px-6 py-4 text-center align-middle" rowspan="2">No.</th>
                    <th class="px-6 py-4 align-middle" colspan="3">Paket Pengadaan</th>
                    <th class="px-6 py-4 align-middle" rowspan="2">Jenis Pengadaan</th>
                    <th class="px-6 py-4 align-middle" rowspan="2">Metode Pengadaan</th>
                    <th class="px-6 py-4 text-right align-middle" rowspan="2">Pagu Anggaran (Rp)</th>
                    <th class="px-6 py-4 text-right align-middle" rowspan="2">Nilai HPS (Rp)</th>
                    <th class="px-6 py-4 text-right align-middle" rowspan="2">Nilai Kontrak (Rp)</th>
                    <th class="px-6 py-4 align-middle" colspan="3">Identitas Penyedia</th>
                    <th class="px-6 py-4 align-middle" colspan="3">Penilaian Kinerja Vendor</th>
                    <th class="px-6 py-4 text-center align-middle" rowspan="2">Rekomendasi Blacklist</th>
                </tr>
                <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 font-semibold uppercase tracking-wider text-[10px]">
                    <th class="px-6 py-3 align-middle">Nama Paket</th>
                    <th class="px-6 py-3 align-middle">Kode RUP</th>
                    <th class="px-6 py-3 align-middle">Nama PA/PPK</th>
                    <th class="px-6 py-3 align-middle">Nama</th>
                    <th class="px-6 py-3 align-middle">Alamat</th>
                    <th class="px-6 py-3 align-middle">HP / Email</th>
                    <th class="px-6 py-3 align-middle text-right">Kemampuan Keuangan (Rp)</th>
                    <th class="px-6 py-3 align-middle">Kemampuan Teknis (SDM & Prasarana)</th>
                    <th class="px-6 py-3 align-middle text-center">Hasil Kinerja Vendor</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-slate-700">
                <?php if (empty($kontraks)) : ?>
                    <tr>
                        <td colspan="16" class="px-6 py-4 text-center text-slate-500">Belum ada data kontrak.</td>
                    </tr>
                <?php else : ?>
                    <?php 
                        $currentPage = isset($pager) ? $pager->getCurrentPage() : 1;
                        $no = ($currentPage - 1) * 10 + 1;
                        foreach ($kontraks as $kontrak) : 
                    ?>
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-6 py-4 text-center font-medium"><?= $no++ ?>.</td>
                            <td class="px-6 py-4 font-semibold text-emerald-700 hover:underline">
                                <a href="<?= base_url('dashboard/form_edit_paket?paket_id=' . $kontrak['paket_id']) ?>"><?= esc($kontrak['nm_paket']) ?></a>
                            </td>
                            <td class="px-6 py-4 font-mono text-xs"><?= esc($kontrak['kode_rup']) ?></td>
                            <td class="px-6 py-4 font-medium"><?= esc($kontrak['ppk_nama'] ?? 'NIP: ' . $kontrak['nip']) ?> / <?= esc($kontrak['nip']) ?></td>
                            <td class="px-6 py-4"><?= esc($kontrak['nm_jenis_kontrak']) ?></td>
                            <td class="px-6 py-4"><?= esc($kontrak['nm_mp']) ?></td>
                            <td class="px-6 py-4 text-right"><?= number_format($kontrak['pagu'], 0, ',', '.') ?></td>
                            <td class="px-6 py-4 text-right"><?= number_format($kontrak['nilai_hps'], 0, ',', '.') ?></td>
                            <td class="px-6 py-4 text-right font-medium"><?= number_format($kontrak['nilai_kontrak'], 0, ',', '.') ?></td>
                            <td class="px-6 py-4 font-semibold"><?= esc($kontrak['nm_pemenang']) ?></td>
                            <td class="px-6 py-4 text-xs"><?= esc($kontrak['alamat_pemenang']) ?></td>
                            <td class="px-6 py-4 text-xs"><?= esc($kontrak['no_hp_email']) ?></td>
                            <td class="px-6 py-4 text-right"><?= number_format($kontrak['kemampuan_keuangan'], 0, ',', '.') ?></td>
                            <td class="px-6 py-4"><?= esc($kontrak['ketersediaan_sdm'] ?: '-') ?> / <?= esc($kontrak['ketersediaan_sarpra'] ?: '-') ?></td>
                            <td class="px-6 py-4 text-center">
                                <?php if ($kontrak['update_penilaian'] == 0) : ?>
                                    <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 block mb-1">Belum Dinilai</span>
                                <?php else : ?>
                                    <?php 
                                        $score = $kontrak['hasil_penilaian'];
                                        $class = 'bg-rose-50 text-rose-700 border-rose-100';
                                        $label = 'BURUK';
                                        if ($score >= 90) {
                                            $class = 'bg-emerald-50 text-emerald-700 border-emerald-100';
                                            $label = 'SANGAT BAIK';
                                        } elseif ($score >= 70) {
                                            $class = 'bg-teal-50 text-teal-700 border-teal-100';
                                            $label = 'BAIK';
                                        } elseif ($score >= 50) {
                                            $class = 'bg-amber-50 text-amber-700 border-amber-100';
                                            $label = 'CUKUP';
                                        }
                                    ?>
                                    <span class="text-xs font-semibold px-2 py-0.5 rounded-full border <?= $class ?> block mb-1"><?= number_format($score, 2) ?> (<?= $label ?>)</span>
                                <?php endif; ?>
                                <a href="<?= base_url('dashboard/penilaian_ppk?kontrak_id=' . $kontrak['kontrak_id']) ?>" class="inline-flex items-center gap-1 bg-teal-600 hover:bg-teal-700 text-white font-medium py-1 px-2.5 rounded-lg text-xs transition duration-150 shadow-sm">
                                    <i class="fas fa-edit text-[10px]"></i> Penilaian PPK
                                </a>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <?php 
                                    $rekomendasi = trim($kontrak['rekomendasi'] ?? '');
                                    if ($rekomendasi === 'Blacklist') : 
                                ?>
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-rose-50 text-rose-700 border border-rose-200 shadow-sm animate-pulse">
                                        <i class="fas fa-ban text-[10px]"></i> Blacklist
                                    </span>
                                <?php elseif ($rekomendasi === 'Tidak Blacklist') : ?>
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 shadow-sm">
                                        <i class="fas fa-check text-[10px]"></i> Aman
                                    </span>
                                <?php else : ?>
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-slate-50 text-slate-400 border border-slate-200">
                                        Belum Diisi
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination Footer -->
    <?php if (isset($pager) && $pager->getPageCount() > 1) : ?>
        <?php 
            $renderer = new \CodeIgniter\Pager\PagerRenderer($pager->getDetails()); 
            $renderer->setSurroundCount(2);
        ?>
        <div class="flex items-center justify-between border-t border-slate-100 px-6 py-4 bg-white rounded-b-2xl shadow-sm">
            <!-- Mobile Pagination -->
            <div class="flex flex-1 justify-between sm:hidden gap-3">
                <?php if ($renderer->hasPrevious()) : ?>
                    <a href="<?= $renderer->getPrevious() ?>" class="relative inline-flex items-center rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 transition">Sebelumnya</a>
                <?php else : ?>
                    <span class="relative inline-flex items-center rounded-xl border border-slate-100 bg-slate-50 px-4 py-2 text-sm font-medium text-slate-400 cursor-not-allowed">Sebelumnya</span>
                <?php endif; ?>
                
                <?php if ($renderer->hasNext()) : ?>
                    <a href="<?= $renderer->getNext() ?>" class="relative inline-flex items-center rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 transition">Selanjutnya</a>
                <?php else : ?>
                    <span class="relative inline-flex items-center rounded-xl border border-slate-100 bg-slate-50 px-4 py-2 text-sm font-medium text-slate-400 cursor-not-allowed">Selanjutnya</span>
                <?php endif; ?>
            </div>
            
            <!-- Desktop Pagination -->
            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-slate-500">
                        Menampilkan halaman <span class="font-semibold text-slate-800"><?= $renderer->getCurrentPageNumber() ?></span> dari <span class="font-semibold text-slate-800"><?= $renderer->getPageCount() ?></span> halaman (Total: <span class="font-semibold text-slate-800"><?= $renderer->getTotal() ?></span> data)
                    </p>
                </div>
                <div>
                    <nav class="inline-flex items-center gap-1.5" aria-label="Pagination">
                        <!-- First Page -->
                        <a href="<?= $renderer->getFirst() ?>" class="relative inline-flex items-center justify-center w-[38px] h-[38px] text-xs font-semibold rounded-xl text-slate-500 hover:bg-slate-50 border border-slate-200 bg-white transition" title="Halaman Pertama">
                            <i class="fas fa-angles-left"></i>
                        </a>
                        
                        <!-- Previous Page -->
                        <?php if ($renderer->hasPrevious()) : ?>
                            <a href="<?= $renderer->getPrevious() ?>" class="relative inline-flex items-center justify-center w-[38px] h-[38px] text-sm font-semibold rounded-xl text-slate-700 hover:bg-slate-50 border border-slate-200 bg-white transition" title="Sebelumnya">
                                <i class="fas fa-chevron-left text-xs"></i>
                            </a>
                        <?php else : ?>
                            <span class="relative inline-flex items-center justify-center w-[38px] h-[38px] text-sm font-semibold rounded-xl text-slate-300 border border-slate-100 bg-slate-50 cursor-not-allowed">
                                <i class="fas fa-chevron-left text-xs"></i>
                            </span>
                        <?php endif; ?>
                        
                        <!-- Page Numbers -->
                        <?php foreach ($renderer->links() as $page) : ?>
                            <a href="<?= $page['uri'] ?>" class="relative inline-flex items-center justify-center min-w-[38px] h-[38px] px-1.5 text-sm font-semibold rounded-xl transition <?= $page['active'] ? 'bg-emerald-600 text-white border border-emerald-600 shadow-sm shadow-emerald-500/10' : 'text-slate-700 hover:bg-slate-50 border border-slate-200 bg-white' ?>">
                                <?= $page['title'] ?>
                            </a>
                        <?php endforeach; ?>
                        
                        <!-- Next Page -->
                        <?php if ($renderer->hasNext()) : ?>
                            <a href="<?= $renderer->getNext() ?>" class="relative inline-flex items-center justify-center w-[38px] h-[38px] text-sm font-semibold rounded-xl text-slate-700 hover:bg-slate-50 border border-slate-200 bg-white transition" title="Selanjutnya">
                                <i class="fas fa-chevron-right text-xs"></i>
                            </a>
                        <?php else : ?>
                            <span class="relative inline-flex items-center justify-center w-[38px] h-[38px] text-sm font-semibold rounded-xl text-slate-300 border border-slate-100 bg-slate-50 cursor-not-allowed">
                                <i class="fas fa-chevron-right text-xs"></i>
                            </span>
                        <?php endif; ?>
                        
                        <!-- Last Page -->
                        <a href="<?= $renderer->getLast() ?>" class="relative inline-flex items-center justify-center w-[38px] h-[38px] text-xs font-semibold rounded-xl text-slate-500 hover:bg-slate-50 border border-slate-200 bg-white transition" title="Halaman Terakhir">
                            <i class="fas fa-angles-right"></i>
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>

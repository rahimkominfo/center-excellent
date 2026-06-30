<?= $this->extend('dashboard/layouts/main') ?>

<?= $this->section('title') ?>Laporan Tepra<?= $this->endSection() ?>

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
                <span class="text-slate-400 font-medium">Laporan Tepra</span>
            </div>
        </li>
    </ol>
</nav>

<!-- Page Header Card -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-8 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div>
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Laporan TEPRA (Tim Evaluasi dan Pengawasan Realisasi Anggaran)</h2>
        <p class="text-sm text-slate-500 mt-1">Realisasi nilai pagu, kontrak penyedia, dan perhitungan sisa anggaran pengadaan</p>
    </div>
</div>

<!-- Filter Card -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-8">
    <h4 class="font-bold text-slate-800 text-sm mb-3">Filter Berdasarkan Kategori Nilai Kontrak</h4>
    <form class="flex flex-wrap items-center gap-3" method="GET" action="<?= base_url('dashboard/lap_tepra') ?>">
        <div class="w-72">
            <select name="filter_val" class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" onchange="this.form.submit()">
                <option value="all" <?= ($filter_val == 'all') ? 'selected' : '' ?>>Semua Paket Pekerjaan</option>
                <option value="1" <?= ($filter_val == '1') ? 'selected' : '' ?>>Paket bernilai kecil (&lt; Rp 200 Juta)</option>
                <option value="2" <?= ($filter_val == '2') ? 'selected' : '' ?>>Paket bernilai sedang (Rp 200 Jt - Rp 2.5 Miliar)</option>
                <option value="3" <?= ($filter_val == '3') ? 'selected' : '' ?>>Paket bernilai besar (&gt; Rp 2.5 Miliar)</option>
            </select>
        </div>
        <input type="hidden" name="search" value="<?= esc($search) ?>">
    </form>
</div>

<!-- Table Card Container -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex flex-wrap items-center justify-between gap-4">
        <h3 class="font-bold text-slate-800">Tabel Data Pengadaan TEPRA</h3>
        <form class="relative" method="GET" action="<?= base_url('dashboard/lap_tepra') ?>">
            <input name="search" class="w-64 pl-9 pr-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition placeholder-slate-400" type="search" placeholder="Cari paket tepra..." value="<?= esc($search) ?>">
            <input type="hidden" name="filter_val" value="<?= esc($filter_val) ?>">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                <i class="fas fa-search text-xs"></i>
            </div>
        </form>
    </div>
    
    <div class="overflow-x-auto custom-scrollbar">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 font-semibold uppercase tracking-wider text-xs">
                    <th class="px-6 py-4 text-center align-middle">No.</th>
                    <th class="px-6 py-4 align-middle">Nama Paket Pekerjaan</th>
                    <th class="px-6 py-4 align-middle">Kategori</th>
                    <th class="px-6 py-4 align-middle">Metode Pemilihan Penyedia</th>
                    <th class="px-6 py-4 text-right align-middle">Pagu (Rp)</th>
                    <th class="px-6 py-4 text-right align-middle">HPS (Rp)</th>
                    <th class="px-6 py-4 text-right align-middle">Kontrak (Rp)</th>
                    <th class="px-6 py-4 text-right align-middle">Sisa Dana (Rp)</th>
                    <th class="px-6 py-4 align-middle">No. & Tgl Kontrak</th>
                    <th class="px-6 py-4 align-middle">Perusahaan Kontraktor</th>
                    <th class="px-6 py-4 align-middle">No. & Tgl BAST</th>
                    <th class="px-6 py-4 text-center align-middle">Keterangan BAST</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-slate-700">
                <?php if (empty($kontraks)) : ?>
                    <tr>
                        <td colspan="12" class="px-6 py-4 text-center text-slate-500">Tidak ada data paket kontrak sesuai filter.</td>
                    </tr>
                <?php else : ?>
                    <?php 
                        $currentPage = isset($pager) ? $pager->getCurrentPage() : 1;
                        $no = ($currentPage - 1) * 10 + 1;
                        foreach ($kontraks as $kontrak) : 
                            $sisa_dana = $kontrak['pagu'] - $kontrak['nilai_kontrak'];
                    ?>
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-6 py-4 text-center font-medium"><?= $no++ ?>.</td>
                            <td class="px-6 py-4 font-semibold text-slate-900"><?= esc($kontrak['nm_paket']) ?></td>
                            <td class="px-6 py-4"><?= esc($kontrak['nm_jenis_kontrak']) ?></td>
                            <td class="px-6 py-4"><?= esc($kontrak['nm_mp']) ?></td>
                            <td class="px-6 py-4 text-right"><?= number_format($kontrak['pagu'], 0, ',', '.') ?></td>
                            <td class="px-6 py-4 text-right"><?= number_format($kontrak['nilai_hps'], 0, ',', '.') ?></td>
                            <td class="px-6 py-4 text-right font-medium text-emerald-600"><?= number_format($kontrak['nilai_kontrak'], 0, ',', '.') ?></td>
                            <td class="px-6 py-4 text-right text-rose-600 font-semibold"><?= number_format($sisa_dana, 0, ',', '.') ?></td>
                            <td class="px-6 py-4 text-xs font-mono">
                                <?= esc($kontrak['no_kontrak'] ?: '-') ?> 
                                <br> 
                                <?= $kontrak['tgl_kontrak'] ? date('d-m-Y', strtotime($kontrak['tgl_kontrak'])) : '-' ?>
                            </td>
                            <td class="px-6 py-4 font-medium"><?= esc($kontrak['nm_pemenang']) ?></td>
                            <td class="px-6 py-4 text-xs"><?= esc($kontrak['no_bast'] ?: '-') ?></td>
                            <td class="px-6 py-4 text-center text-xs font-medium text-slate-500">
                                <?= $kontrak['tgl_bast'] ? date('d-m-Y', strtotime($kontrak['tgl_bast'])) : '-' ?>
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

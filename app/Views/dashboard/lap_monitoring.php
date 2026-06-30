<?= $this->extend('dashboard/layouts/main') ?>

<?= $this->section('title') ?>Laporan Monitoring Pengadaan<?= $this->endSection() ?>

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
                <span class="text-slate-400 font-medium">Laporan Monitoring</span>
            </div>
        </li>
    </ol>
</nav>

<!-- Page Header Card -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-8">
    <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Laporan Monitoring Fisik Keuangan</h2>
    <p class="text-sm text-slate-500 mt-1">Realisasi berkas jaminan, adendum penambahan waktu kerja dan status pembayaran SP2D</p>
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
    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex flex-wrap items-center justify-between gap-4">
        <h3 class="font-bold text-slate-800">Daftar Laporan Proyek</h3>
        <form class="relative" method="GET" action="<?= base_url('dashboard/lap_monitoring') ?>">
            <input name="search" class="w-64 pl-9 pr-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition placeholder-slate-400" type="search" placeholder="Cari laporan..." value="<?= esc($search) ?>">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                <i class="fas fa-search text-xs"></i>
            </div>
        </form>
    </div>
    
    <div class="overflow-x-auto custom-scrollbar">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 font-semibold uppercase tracking-wider text-xs">
                    <th class="px-4 py-4 text-center align-middle" colspan="9">KONTRAK</th>
                    <th class="px-4 py-4 text-center align-middle" colspan="2">BAST</th>
                    <th class="px-4 py-4 text-center align-middle" rowspan="3">Persentase Penyelesaian</th>
                    <th class="px-4 py-4 text-center align-middle" rowspan="3">Addendum/<br>SP2D</th>
                    <th class="px-4 py-4 text-center align-middle" rowspan="3">Aksi</th>
                </tr>
                <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 font-semibold uppercase tracking-wider text-[10px]">
                    <th class="px-4 py-3 text-center align-middle" rowspan="2">NOMOR</th>
                    <th class="px-4 py-3 align-middle" rowspan="2">PERIHAL</th>
                    <th class="px-4 py-3 align-middle" rowspan="2">PELAKSANA</th>
                    <th class="px-4 py-3 align-middle" rowspan="2">TANGGAL</th>
                    <th class="px-4 py-3 text-right align-middle" rowspan="2">NILAI (Rp)</th>
                    <th class="px-4 py-3 align-middle" rowspan="2">JAMINAN</th>
                    <th class="px-4 py-3 text-center align-middle" colspan="2">PELAKSANAAN</th>
                    <th class="px-4 py-3 align-middle text-center">PEMELIHARAAN</th>
                    <th class="px-4 py-3 text-center align-middle" rowspan="2">NO</th>
                    <th class="px-4 py-3 text-center align-middle" rowspan="2">TANGGAL</th>
                </tr>
                <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 font-semibold uppercase tracking-wider text-[10px]">
                    <th class="px-4 py-2 text-center align-middle">JANGKA WAKTU</th>
                    <th class="px-4 py-2 text-center align-middle">PERIODE</th>
                    <th class="px-4 py-2 text-center align-middle">JANGKA WAKTU</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-slate-700">
                <?php if (empty($kontraks)) : ?>
                    <tr>
                        <td colspan="14" class="px-6 py-4 text-center text-slate-500">Belum ada data kontrak.</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($kontraks as $kontrak) : ?>
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-4 py-4 text-center font-semibold text-slate-800"><?= esc($kontrak['no_kontrak'] ?: '-') ?></td>
                            <td class="px-4 py-4"><?= esc($kontrak['nm_paket']) ?></td>
                            <td class="px-4 py-4 font-medium text-slate-900"><?= esc($kontrak['nm_pemenang']) ?></td>
                            <td class="px-4 py-4"><?= $kontrak['tgl_kontrak'] ? date('d-m-Y', strtotime($kontrak['tgl_kontrak'])) : '-' ?></td>
                            <td class="px-4 py-4 text-right font-medium"><?= number_format($kontrak['nilai_kontrak'], 0, ',', '.') ?></td>
                            <td class="px-4 py-4"><?= esc($kontrak['jaminan'] ?: '-') ?></td>
                            <td class="px-4 py-4 text-center font-medium">
                                <?php 
                                    if ($kontrak['tgl_mulai_kontrak'] && $kontrak['tgl_akhir_kontrak']) {
                                        $diff = abs(strtotime($kontrak['tgl_akhir_kontrak']) - strtotime($kontrak['tgl_mulai_kontrak']));
                                        echo floor($diff / (60 * 60 * 24)) . ' hari';
                                    } else {
                                        echo '-';
                                    }
                                ?>
                            </td>
                            <td class="px-4 py-4 text-center text-xs">
                                <?= $kontrak['tgl_mulai_kontrak'] ? date('d M Y', strtotime($kontrak['tgl_mulai_kontrak'])) : '' ?> 
                                s/d 
                                <?= $kontrak['tgl_akhir_kontrak'] ? date('d M Y', strtotime($kontrak['tgl_akhir_kontrak'])) : '' ?>
                            </td>
                            <td class="px-4 py-4 text-center"><?= esc($kontrak['waktu_pemeliharaan']) ?> hari</td>
                            <td class="px-4 py-4 text-center"><?= esc($kontrak['no_bast'] ?: '-') ?></td>
                            <td class="px-4 py-4 text-center"><?= $kontrak['tgl_bast'] ? date('d-m-Y', strtotime($kontrak['tgl_bast'])) : '-' ?></td>
                            <td class="px-4 py-4 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <?php 
                                        $percent = $kontrak['persen_penyelesaian'];
                                        $color = 'text-rose-600 bg-rose-50';
                                        if ($percent == 100) {
                                            $color = 'text-emerald-600 bg-emerald-50';
                                        } elseif ($percent >= 50) {
                                            $color = 'text-amber-600 bg-amber-50';
                                        }
                                    ?>
                                    <span class="font-bold px-2 py-0.5 rounded-lg text-xs <?= $color ?>"><?= $percent ?>%</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-center">
                                <div class="flex flex-col gap-1 items-center">
                                    <a class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-1 px-2.5 rounded-lg text-xs transition shadow-sm w-20 text-center" href="<?= base_url('dashboard/addendum?kontrak_id=' . $kontrak['kontrak_id']) ?>">Addendum</a>
                                    <a class="bg-slate-600 hover:bg-slate-700 text-white font-bold py-1 px-2.5 rounded-lg text-xs transition shadow-sm w-20 text-center" href="<?= base_url('dashboard/sp2d?kontrak_id=' . $kontrak['kontrak_id']) ?>">SP2D</a>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="<?= base_url('dashboard/form_edit_kontrak?kontrak_id=' . $kontrak['kontrak_id']) ?>" class="text-slate-500 hover:text-emerald-600 p-1 transition" title="Edit"><i class="fas fa-edit"></i></a>
                                    <a href="<?= base_url('kontrak/delete/' . $kontrak['kontrak_id']) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus kontrak ini?')" class="text-slate-400 hover:text-rose-600 p-1 transition" title="Hapus"><i class="fas fa-trash"></i></a>
                                </div>
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

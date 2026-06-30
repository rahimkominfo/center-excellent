<?= $this->extend('dashboard/layouts/main') ?>

<?= $this->section('title') ?>Penilaian Kinerja PPK<?= $this->endSection() ?>

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
                <span class="text-slate-400 font-medium">Penilaian PPK</span>
            </div>
        </li>
    </ol>
</nav>

<!-- Page Header Card -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-8 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div class="flex items-center gap-4">
        <button onclick="goBack()" class="bg-slate-100 hover:bg-slate-200 text-slate-700 w-10 h-10 rounded-xl flex items-center justify-center transition" title="Kembali">
            <i class="fas fa-arrow-left"></i>
        </button>
        <div>
            <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Formulir Penilaian Kinerja Vendor oleh PPK</h2>
            <p class="text-sm text-slate-500 mt-1">Evaluasi Aspek Teknis, Finansial, dan Indikator Proyek</p>
        </div>
    </div>
</div>

<form action="<?= base_url('dashboard/penilaian_ppk/store') ?>" method="POST">
    <input type="hidden" name="kontrak_id" value="<?= esc($kontrak['kontrak_id']) ?>">
    
    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Package Details & Form 1 -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Details Card -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                <h3 class="font-bold text-slate-800 text-base border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                    <i class="fas fa-info-circle text-emerald-500"></i> Detail Paket & PPK
                </h3>
                <div class="space-y-4 text-sm text-slate-600">
                    <div>
                        <span class="text-xs font-semibold text-slate-400 block uppercase">OPD</span>
                        <span class="font-medium text-slate-800"><?= esc($kontrak['unit_nama']) ?></span>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-slate-400 block uppercase">Nama PPK</span>
                        <span class="font-medium text-slate-800"><?= esc($kontrak['ppk_nama'] ?? 'NIP: ' . $kontrak['nip']) ?> / <?= esc($kontrak['nip']) ?></span>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-slate-400 block uppercase">Nama Paket Pekerjaan</span>
                        <span class="font-medium text-slate-800"><?= esc($kontrak['nm_paket']) ?></span>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-slate-400 block uppercase">Nilai Kontrak</span>
                        <span class="font-bold text-emerald-600">Rp <?= number_format($kontrak['nilai_kontrak'], 0, ',', '.') ?></span>
                    </div>
                    <div>
                        <span class="text-xs font-semibold text-slate-400 block uppercase">Nama Perusahaan</span>
                        <span class="font-medium text-slate-800"><?= esc($kontrak['nm_pemenang']) ?></span>
                    </div>
                </div>
            </div>

            <!-- Form 1: Kemampuan -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
                <h3 class="font-bold text-slate-800 text-base border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                    <i class="fas fa-sliders text-emerald-500"></i> Kemampuan & Rekomendasi
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Kemampuan Keuangan</label>
                        <input class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" name="kemampuan_keuangan" value="<?= number_format($kontrak['kemampuan_keuangan'], 0, ',', '.') ?>" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Kemampuan Teknis SDM</label>
                        <select name="ketersediaan_sdm" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" required>
                            <option value="Sesuai" <?= ($kontrak['ketersediaan_sdm'] == 'Sesuai') ? 'selected' : '' ?>>Sesuai</option>
                            <option value="Cukup Sesuai" <?= ($kontrak['ketersediaan_sdm'] == 'Cukup Sesuai') ? 'selected' : '' ?>>Cukup Sesuai</option>
                            <option value="Kurang Sesuai" <?= ($kontrak['ketersediaan_sdm'] == 'Kurang Sesuai') ? 'selected' : '' ?>>Kurang Sesuai</option>
                            <option value="Tidak Sesuai" <?= ($kontrak['ketersediaan_sdm'] == 'Tidak Sesuai') ? 'selected' : '' ?>>Tidak Sesuai</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Kemampuan Teknis Prasarana</label>
                        <select name="ketersediaan_sarpra" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" required>
                            <option value="Sesuai" <?= ($kontrak['ketersediaan_sarpra'] == 'Sesuai') ? 'selected' : '' ?>>Sesuai</option>
                            <option value="Cukup Sesuai" <?= ($kontrak['ketersediaan_sarpra'] == 'Cukup Sesuai') ? 'selected' : '' ?>>Cukup Sesuai</option>
                            <option value="Kurang Sesuai" <?= ($kontrak['ketersediaan_sarpra'] == 'Kurang Sesuai') ? 'selected' : '' ?>>Kurang Sesuai</option>
                            <option value="Tidak Sesuai" <?= ($kontrak['ketersediaan_sarpra'] == 'Tidak Sesuai') ? 'selected' : '' ?>>Tidak Sesuai</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Rekomendasi Blacklist</label>
                        <select name="rekomendasi" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" required>
                            <option value="Tidak Blacklist" <?= ($kontrak['rekomendasi'] == 'Tidak Blacklist') ? 'selected' : '' ?>>Tidak Blacklist</option>
                            <option value="Blacklist" <?= ($kontrak['rekomendasi'] == 'Blacklist') ? 'selected' : '' ?>>Blacklist</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Performance Indicators Grid -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="font-bold text-slate-800 text-base">Aspek & Indikator Penilaian Kinerja</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Input nilai (1 - 100) untuk setiap indikator aspek kinerja berikut</p>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-sm">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 font-semibold uppercase tracking-wider text-xs">
                                <th class="px-6 py-3 text-center w-16">No.</th>
                                <th class="px-6 py-3">Aspek Penilaian</th>
                                <th class="px-6 py-3">Indikator Penilaian</th>
                                <th class="px-6 py-3 text-center w-24">Nilai</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            <?php if (empty($indicators)) : ?>
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-slate-500">Belum ada indikator yang dikonfigurasi untuk tipe kontrak ini. Silakan tambahkan di modul Master Indikator.</td>
                                </tr>
                            <?php else : ?>
                                <?php $no = 1; foreach ($indicators as $ind) : 
                                    $score = $existing_ratings[$ind['kd_indikator_kinerja']] ?? 80;
                                ?>
                                    <tr class="hover:bg-slate-50/50 transition">
                                        <td class="px-6 py-4 text-center font-medium"><?= $no++ ?>.</td>
                                        <td class="px-6 py-4 font-semibold"><?= esc($ind['nm_aspek_kinerja']) ?></td>
                                        <td class="px-6 py-4"><?= esc($ind['nm_indikator']) ?></td>
                                        <td class="px-6 py-4 text-center">
                                            <input class="nilai-input w-20 px-3 py-1.5 border border-slate-200 rounded-lg text-center font-bold focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-emerald-700" type="number" min="0" max="100" name="nilai[<?= $ind['kd_indikator_kinerja'] ?>]" data-bobot="<?= esc($ind['bobot_indikator']) ?>" value="<?= esc($score) ?>" oninput="calculateTotal()" required>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                
                                <!-- Total Score Row -->
                                <tr class="bg-emerald-50/40 border-t-2 border-emerald-100 font-bold">
                                    <td colspan="3" class="px-6 py-4 text-right text-slate-800 uppercase tracking-wider">
                                        Total Penilaian Kinerja Vendor: <span id="performance-label" class="text-emerald-700 ml-2 font-extrabold text-sm">SANGAT BAIK</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span id="performance-score" class="text-emerald-700 font-extrabold text-lg">0.00</span>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <?php if (!empty($indicators)) : ?>
                    <div class="px-6 py-4 border-t border-slate-100 flex justify-end gap-3 bg-slate-50/30">
                        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2 px-6 rounded-xl text-sm transition duration-150 shadow-md shadow-emerald-600/15 flex items-center gap-2">
                            <i class="fas fa-paper-plane text-xs"></i> Kirim Nilai Kinerja
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</form>

<script>
    function calculateTotal() {
        const inputs = document.querySelectorAll('.nilai-input');
        let totalVal = 0;
        let totalBobot = 0;
        
        inputs.forEach(input => {
            const val = parseFloat(input.value) || 0;
            const bobot = parseFloat(input.getAttribute('data-bobot')) || 0;
            totalVal += (val * bobot) / 100;
            totalBobot += bobot;
        });
        
        const finalScore = totalVal.toFixed(2);
        document.getElementById('performance-score').textContent = finalScore;
        
        let label = "";
        let colorClass = "text-emerald-700";
        if (totalVal <= 50) {
            label = "SANGAT KURANG";
            colorClass = "text-rose-700";
        } else if (totalVal <= 60) {
            label = "KURANG";
            colorClass = "text-rose-600";
        } else if (totalVal <= 70) {
            label = "CUKUP BAIK";
            colorClass = "text-amber-600";
        } else if (totalVal <= 80) {
            label = "BAIK";
            colorClass = "text-teal-700";
        } else {
            label = "SANGAT BAIK";
            colorClass = "text-emerald-700";
        }
        
        const labelEl = document.getElementById('performance-label');
        if (labelEl) {
            labelEl.textContent = label;
            labelEl.className = "ml-2 font-extrabold text-sm " + colorClass;
        }
    }

    // Run initial calculation
    window.addEventListener('DOMContentLoaded', () => {
        calculateTotal();
    });
</script>
<?= $this->endSection() ?>

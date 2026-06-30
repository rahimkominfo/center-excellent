<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('title') ?>Penilaian Pejabat PPK<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Page Header Card -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-8 flex items-center gap-4">
    <button onclick="goBack()" class="bg-slate-100 hover:bg-slate-200 text-slate-700 w-10 h-10 rounded-xl flex items-center justify-center transition" title="Kembali">
        <i class="fas fa-arrow-left"></i>
    </button>
    <div>
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Kuesioner Penilaian Kinerja oleh PPK</h2>
        <p class="text-sm text-slate-500 mt-1">Formulir evaluasi terperinci untuk paket proyek aktif</p>
    </div>
</div>

<!-- Form Card Container -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-8 max-w-4xl mx-auto">
    <div class="border-b border-slate-100 pb-4 mb-6">
        <h3 class="font-bold text-slate-800 text-lg">Pembangunan Gedung Laboratorium RSUD Sinjai</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-3 text-sm text-slate-600">
            <div><strong>OPD:</strong> Rumah Sakit Umum Daerah (RSUD) Sinjai</div>
            <div><strong>PPK:</strong> Ahmad Yani, S.T. / NIP. 197805122002121003</div>
            <div><strong>Pemenang:</strong> PT. Karya Sinjai Abadi</div>
            <div><strong>Nilai Kontrak:</strong> Rp 11.890.000.000</div>
        </div>
    </div>
    
    <form class="space-y-6" onsubmit="event.preventDefault(); alert('Penilaian PPK dikirim!'); goBack();">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 font-semibold uppercase tracking-wider text-xs">
                        <th class="px-6 py-3 text-center w-16">No.</th>
                        <th class="px-6 py-3">Aspek Penilaian</th>
                        <th class="px-6 py-3">Indikator Penilaian</th>
                        <th class="px-6 py-3 text-center w-28">Nilai (1-100)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-6 py-4 text-center font-medium">1.</td>
                        <td class="px-6 py-4 font-semibold">Kualitas Pekerjaan</td>
                        <td class="px-6 py-4">Kesesuaian hasil terhadap spesifikasi teknis dan gambar rencana proyek</td>
                        <td class="px-6 py-4">
                            <input class="w-20 px-3 py-1.5 border border-slate-200 rounded-lg text-center font-bold text-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500" type="number" name="n_1" value="90">
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-6 py-4 text-center font-medium">2.</td>
                        <td class="px-6 py-4 font-semibold">Kualitas Pekerjaan</td>
                        <td class="px-6 py-4">Kerapian hasil akhir pekerjaan (finishing) dan pembersihan lokasi</td>
                        <td class="px-6 py-4">
                            <input class="w-20 px-3 py-1.5 border border-slate-200 rounded-lg text-center font-bold text-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500" type="number" name="n_2" value="85">
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-6 py-4 text-center font-medium">3.</td>
                        <td class="px-6 py-4 font-semibold">Waktu Penyelesaian</td>
                        <td class="px-6 py-4">Ketepatan waktu penyerahan pekerjaan sesuai jadwal pelaksanaan kontrak (Milestone)</td>
                        <td class="px-6 py-4">
                            <input class="w-20 px-3 py-1.5 border border-slate-200 rounded-lg text-center font-bold text-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500" type="number" name="n_3" value="88">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">
            <button type="button" onclick="goBack()" class="px-4 py-2 border border-slate-200 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 transition">Batal</button>
            <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-sm font-semibold transition shadow-md shadow-emerald-600/10 flex items-center gap-1.5">
                <i class="fas fa-paper-plane text-xs"></i> Kirim Nilai
            </button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>

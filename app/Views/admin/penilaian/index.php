<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('title') ?>Daftar Pengadaan Barang & Jasa<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Page Header Card -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-8 text-center max-w-xl mx-auto">
    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">KATEGORI PENILAIAN</h2>
    <p class="text-sm text-slate-500 mt-1">Konfigurasi master data aspek, indikator penilaian, paket proyek & PPK pejabat</p>
</div>

<!-- Navigation Grid Menu -->
<div class="max-w-md mx-auto space-y-4">
    <a href="<?= base_url('penilaian/aspek_kinerja') ?>" class="flex items-center justify-between p-4 bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:border-emerald-200 group transition duration-150">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition duration-200">
                <i class="fas fa-shapes text-lg"></i>
            </div>
            <span class="font-bold text-slate-800">ASPEK KINERJA</span>
        </div>
        <i class="fas fa-chevron-right text-slate-300 group-hover:text-emerald-500 transition"></i>
    </a>
    
    <a href="<?= base_url('penilaian/indikator_kinerja') ?>" class="flex items-center justify-between p-4 bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:border-emerald-200 group transition duration-150">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center group-hover:bg-teal-600 group-hover:text-white transition duration-200">
                <i class="fas fa-list-check text-lg"></i>
            </div>
            <span class="font-bold text-slate-800">INDIKATOR KINERJA</span>
        </div>
        <i class="fas fa-chevron-right text-slate-300 group-hover:text-teal-500 transition"></i>
    </a>
    
    <a href="<?= base_url('kontrak/paket') ?>" class="flex items-center justify-between p-4 bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:border-emerald-200 group transition duration-150">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center group-hover:bg-amber-500 group-hover:text-white transition duration-200">
                <i class="fas fa-box text-lg"></i>
            </div>
            <span class="font-bold text-slate-800">KONTRAK / PAKET</span>
        </div>
        <i class="fas fa-chevron-right text-slate-300 group-hover:text-amber-500 transition"></i>
    </a>
    
    <a href="<?= base_url('kontrak/ppk') ?>" class="flex items-center justify-between p-4 bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-md hover:border-emerald-200 group transition duration-150">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center group-hover:bg-rose-600 group-hover:text-white transition duration-200">
                <i class="fas fa-user-tie text-lg"></i>
            </div>
            <span class="font-bold text-slate-800">PEJABAT PEMBUAT KOMITMEN (PPK)</span>
        </div>
        <i class="fas fa-chevron-right text-slate-300 group-hover:text-rose-50 transition"></i>
    </a>
</div>
<?= $this->endSection() ?>

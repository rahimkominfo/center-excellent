<?= $this->extend('dashboard/layouts/main') ?>

<?= $this->section('title') ?>Dashboard Utama<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="max-w-4xl mx-auto flex flex-col justify-center items-center text-center min-h-[70vh]">
    <!-- Emblem -->
    <div class="w-24 h-24 bg-white/90 border border-slate-100 rounded-3xl flex items-center justify-center mb-6 shadow-sm">
        <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo" class="w-16 h-16 object-contain">
    </div>

    <!-- Alert Notifications -->
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="w-full max-w-xl mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-3 text-left shadow-sm">
            <i class="fas fa-check-circle text-lg text-emerald-500 flex-shrink-0"></i>
            <span class="text-sm font-semibold"><?= session()->getFlashdata('success') ?></span>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="w-full max-w-xl mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl flex items-center gap-3 text-left shadow-sm">
            <i class="fas fa-exclamation-circle text-lg text-rose-500 flex-shrink-0"></i>
            <span class="text-sm font-semibold"><?= session()->getFlashdata('error') ?></span>
        </div>
    <?php endif; ?>
    
    <!-- Title -->
    <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight mb-2">
        E-CENTER OF EXCELLENT
    </h2>
    <h3 class="text-base md:text-lg font-medium text-emerald-700 tracking-wide mb-6 uppercase">
        Bagian Pengadaan Barang dan Jasa Kabupaten Sinjai
    </h3>
    
    <p class="text-slate-500 max-w-xl text-sm leading-relaxed mb-8">
        Elektronik System Informasi Penilaian Kinerja Penyedia, Laporan Hasil Monitoring Keuangan dan Tepra Pengadaan Barang dan Jasa Pemerintah Daerah Kabupaten Sinjai.
    </p>
    
    <!-- Big Navigation Cards Row -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-3xl mt-4">
        <!-- Penilaian -->
        <a href="<?= base_url('dashboard/kontrak_ppk') ?>" class="group bg-white p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col items-center justify-center">
            <img src="<?= base_url('assets/img/logo_penilaian.png') ?>" alt="Penilaian Vendor" class="w-48 h-48 object-contain group-hover:scale-105 transition duration-300">
        </a>
        
        <!-- Monitoring -->
        <a href="<?= base_url('dashboard/lap_monitoring') ?>" class="group bg-white p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col items-center justify-center">
            <img src="<?= base_url('assets/img/logo_monitoring.png') ?>" alt="Monitoring Fisik" class="w-48 h-48 object-contain group-hover:scale-105 transition duration-300">
        </a>
        
        <!-- Tepra -->
        <a href="<?= base_url('dashboard/lap_tepra') ?>" class="group bg-white p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-300 flex flex-col items-center justify-center">
            <img src="<?= base_url('assets/img/logo_laporan_tempra.png') ?>" alt="Laporan Tepra" class="w-48 h-48 object-contain group-hover:scale-105 transition duration-300">
        </a>
    </div>
</div>
<?= $this->endSection() ?>

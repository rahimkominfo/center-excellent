<?= $this->extend('dashboard/layouts/main') ?>

<?= $this->section('title') ?>Edit Kontrak Pekerjaan<?= $this->endSection() ?>

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
                <i class="fas fa-chevron-right text-xs text-slate-300 mr-2"></i> Kontrak PPK
            </a>
        </li>
        <li>
            <div class="flex items-center">
                <i class="fas fa-chevron-right text-xs text-slate-300 mr-2"></i>
                <span class="text-slate-400 font-medium">Perbaharui Kontrak</span>
            </div>
        </li>
    </ol>
</nav>

<!-- Form Container Card -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm max-w-3xl mx-auto overflow-hidden">
    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-4">
        <button onclick="goBack()" class="bg-slate-100 hover:bg-slate-200 text-slate-700 w-8 h-8 rounded-lg flex items-center justify-center transition" title="Kembali">
            <i class="fas fa-arrow-left text-xs"></i>
        </button>
        <div>
            <h3 class="font-bold text-slate-800 text-lg">Perbaharui Detail Kontrak Pekerjaan</h3>
            <p class="text-xs text-slate-500"><?= esc($kontrak['nm_paket']) ?></p>
        </div>
    </div>
    
    <form class="p-6 space-y-4" action="<?= base_url('dashboard/form_edit_kontrak/update') ?>" method="POST">
        <input type="hidden" name="kontrak_id" value="<?= esc($kontrak['kontrak_id']) ?>">

        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <label class="md:col-span-3 text-sm font-semibold text-slate-600 md:text-right pr-4">Nomor Kontrak</label>
            <div class="md:col-span-9">
                <input class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" name="no_kontrak" value="<?= esc($kontrak['no_kontrak']) ?>" required>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <label class="md:col-span-3 text-sm font-semibold text-slate-600 md:text-right pr-4">Jaminan</label>
            <div class="md:col-span-9">
                <input class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" name="jaminan" value="<?= esc($kontrak['jaminan']) ?>" required>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <label class="md:col-span-3 text-sm font-semibold text-slate-600 md:text-right pr-4">Tanggal Kontrak</label>
            <div class="md:col-span-9">
                <input class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="date" name="tgl_kontrak" value="<?= esc($kontrak['tgl_kontrak']) ?>">
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <label class="md:col-span-3 text-sm font-semibold text-slate-600 md:text-right pr-4">Tanggal Mulai</label>
            <div class="md:col-span-9">
                <input class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="date" name="tgl_mulai_kontrak" value="<?= esc($kontrak['tgl_mulai_kontrak']) ?>">
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <label class="md:col-span-3 text-sm font-semibold text-slate-600 md:text-right pr-4">Tanggal Akhir</label>
            <div class="md:col-span-9">
                <input class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="date" name="tgl_akhir_kontrak" value="<?= esc($kontrak['tgl_akhir_kontrak']) ?>">
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <label class="md:col-span-3 text-sm font-semibold text-slate-600 md:text-right pr-4">Waktu Pemeliharaan (Hari)</label>
            <div class="md:col-span-9">
                <input class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="number" name="waktu_pemeliharaan" value="<?= esc($kontrak['waktu_pemeliharaan']) ?>" required>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <label class="md:col-span-3 text-sm font-semibold text-slate-600 md:text-right pr-4">No BAST</label>
            <div class="md:col-span-9">
                <input class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" name="no_bast" value="<?= esc($kontrak['no_bast']) ?>">
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <label class="md:col-span-3 text-sm font-semibold text-slate-600 md:text-right pr-4">Tanggal BAST</label>
            <div class="md:col-span-9">
                <input class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="date" name="tgl_bast" value="<?= esc($kontrak['tgl_bast']) ?>">
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
            <label class="md:col-span-3 text-sm font-semibold text-slate-600 md:text-right pr-4">Persen Penyelesaian (%)</label>
            <div class="md:col-span-9">
                <input class="w-full px-4 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="number" name="persen_penyelesaian" min="0" max="100" value="<?= esc($kontrak['persen_penyelesaian']) ?>" required>
            </div>
        </div>
        
        <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
            <button type="button" onclick="goBack()" class="px-4 py-2 border border-slate-200 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 transition">Batal</button>
            <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-sm font-semibold transition shadow-md shadow-emerald-600/10">Simpan Perubahan</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>

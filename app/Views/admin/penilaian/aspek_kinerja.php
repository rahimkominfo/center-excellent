<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('title') ?>Aspek Kinerja PBJ<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Page Header Card -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-8 flex items-center gap-4">
    <button onclick="goBack()" class="bg-slate-100 hover:bg-slate-200 text-slate-700 w-10 h-10 rounded-xl flex items-center justify-center transition" title="Kembali">
        <i class="fas fa-arrow-left"></i>
    </button>
    <div>
        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Master Aspek Penilaian Kinerja</h2>
        <p class="text-sm text-slate-500 mt-1">Konfigurasi bobot penilaian berdasarkan Jenis Kontrak</p>
    </div>
</div>

<!-- Alert notifications -->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-2xl flex items-center gap-3">
        <i class="fas fa-check-circle text-lg"></i>
        <span class="text-sm font-semibold"><?= session()->getFlashdata('success') ?></span>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl flex items-center gap-3">
        <i class="fas fa-exclamation-circle text-lg"></i>
        <span class="text-sm font-semibold"><?= session()->getFlashdata('error') ?></span>
    </div>
<?php endif; ?>

<!-- Select & Add Row -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
    <div class="flex items-center gap-3 w-80">
        <label class="text-sm font-semibold text-slate-500 shrink-0">Jenis Kontrak:</label>
        <select class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" onchange="window.location.href='<?= base_url('penilaian/aspek_kinerja?kj_id=') ?>' + this.value">
            <?php foreach ($jenis_kontrak as $jk) : ?>
                <option value="<?= $jk['kj_id'] ?>" <?= ($jk['kj_id'] == $selected_kj) ? 'selected' : '' ?>><?= esc($jk['nm_jenis_kontrak']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div>
        <button onclick="openModal('modal-aspek')" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2 px-4 rounded-xl text-sm transition duration-150 flex items-center gap-2 shadow-lg shadow-emerald-600/10">
            <i class="fas fa-plus"></i> Tambah Aspek
        </button>
    </div>
</div>

<!-- Table Card Container -->
<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <form class="p-6 space-y-4" action="<?= base_url('penilaian/aspek_kinerja/update_bobot') ?>" method="POST">
        <input type="hidden" name="kj_id" value="<?= $selected_kj ?>">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 font-semibold uppercase tracking-wider text-xs">
                        <th class="px-6 py-4 text-center w-20">No.</th>
                        <th class="px-6 py-4">Aspek Kinerja</th>
                        <th class="px-6 py-4 text-center w-36">Bobot (%)</th>
                        <th class="px-6 py-4 text-center w-24">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    <?php if (empty($aspeks)) : ?>
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-slate-500">Belum ada aspek kinerja yang terdaftar untuk jenis kontrak ini.</td>
                        </tr>
                    <?php else : ?>
                        <?php $no = 1; $total_bobot = 0; foreach ($aspeks as $aspek) : $total_bobot += $aspek['bobot']; ?>
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-6 py-4 text-center font-medium"><?= $no++ ?>.</td>
                                <td class="px-6 py-4 font-semibold text-slate-900"><?= esc($aspek['nm_aspek_kinerja']) ?></td>
                                <td class="px-6 py-4 text-center">
                                    <input class="w-20 px-3 py-1 border border-slate-200 rounded-lg text-center font-bold" type="number" name="bobot[<?= $aspek['kd_aspek_kinerja'] ?>]" value="<?= esc($aspek['bobot']) ?>" min="0" max="100">
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="<?= base_url('penilaian/aspek_kinerja/delete/' . $aspek['kd_aspek_kinerja']) ?>" onclick="return confirm('Yakin ingin menghapus aspek kinerja ini?')" class="text-slate-400 hover:text-rose-600 p-2 transition"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
                <?php if (!empty($aspeks)) : ?>
                    <tfoot>
                        <tr class="bg-slate-50/50 border-t border-slate-200 font-bold text-slate-800">
                            <td colspan="2" class="px-6 py-4 text-right">Jumlah Total:</td>
                            <td class="px-6 py-4 text-center <?= ($total_bobot != 100) ? 'text-rose-600' : 'text-emerald-600' ?>"><?= $total_bobot ?> %</td>
                            <td></td>
                        </tr>
                    </tfoot>
                <?php endif; ?>
            </table>
        </div>
        
        <?php if (!empty($aspeks)) : ?>
            <div class="flex justify-end pt-4 border-t border-slate-100">
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2 px-6 rounded-xl text-sm transition duration-150 shadow-md shadow-emerald-600/10 flex items-center gap-1.5">
                    <i class="fas fa-paper-plane text-xs"></i> Simpan Bobot
                </button>
            </div>
        <?php endif; ?>
    </form>
</div>

<!-- Modal Tambah Aspek -->
<div id="modal-aspek" class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl border border-slate-100 w-full max-w-md shadow-2xl overflow-hidden flex flex-col animate-in zoom-in-95 duration-200">
        <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
            <h3 class="font-bold text-slate-800 text-lg">Tambah Aspek Kinerja</h3>
            <button onclick="closeModal('modal-aspek')" class="text-slate-400 hover:text-slate-600 focus:outline-none"><i class="fas fa-times text-lg"></i></button>
        </div>
        <form class="p-6 space-y-4" action="<?= base_url('penilaian/aspek_kinerja/store') ?>" method="POST">
            <input type="hidden" name="kj_id" value="<?= $selected_kj ?>">
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Nama Aspek Kinerja</label>
                <input name="nm_aspek_kinerja" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="text" placeholder="Masukkan nama aspek..." required>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-500 uppercase mb-1">Bobot (%)</label>
                <input name="bobot" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition" type="number" placeholder="Masukkan bobot aspek..." min="0" max="100" required>
            </div>
            <div class="pt-4 border-t border-slate-100 flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-aspek')" class="px-4 py-2 border border-slate-200 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 transition">Batal</button>
                <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-sm font-semibold transition shadow-md shadow-emerald-600/10">Simpan</button>
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

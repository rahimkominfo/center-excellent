<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang - PBJ Penilaian</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-gradient-to-tr from-slate-900 via-emerald-950 to-slate-900 text-slate-100 flex flex-col font-sans">
    
    <div class="flex-1 flex flex-col justify-center items-center px-4 py-12">
        <!-- Brand Section -->
        <div class="text-center mb-8 max-w-2xl">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight bg-gradient-to-r from-emerald-400 via-teal-300 to-amber-300 bg-clip-text text-transparent drop-shadow-sm mb-4">
                SELAMAT DATANG
            </h1>
            <p class="text-slate-400 font-medium">Sistem Monitoring dan Penilaian Kinerja Pengadaan Barang & Jasa</p>
        </div>
        
        <!-- Logo Icons Row -->
        <div class="flex flex-wrap items-center justify-center gap-8 mb-12 bg-white/5 backdrop-blur-md p-6 rounded-2xl border border-white/10 shadow-xl">
            <a href="http://ukpbj.sinjaikab.go.id/" target="_blank" class="flex flex-col items-center hover:scale-105 transition duration-300 group" title="Website Resmi UKPBJ">
                <div class="w-16 h-16 rounded-xl bg-emerald-500/20 flex items-center justify-center border border-emerald-500/30 group-hover:border-emerald-500/60 mb-2">
                    <i class="fas fa-globe text-3xl text-emerald-400"></i>
                </div>
                <span class="text-xs font-semibold text-slate-300 group-hover:text-emerald-400">WEBSITE RESMI UKPBJ</span>
            </a>
            
            <div class="h-10 w-[1px] bg-slate-700 hidden sm:block"></div>
            
            <a href="<?= base_url('dashboard') ?>" class="flex flex-col items-center hover:scale-105 transition duration-300 group" title="Akses Dashboard">
                <div class="w-20 h-20 rounded-2xl bg-amber-500/20 flex items-center justify-center border border-amber-500/30 group-hover:border-amber-500/60 mb-2">
                    <i class="fas fa-desktop text-4xl text-amber-400"></i>
                </div>
                <span class="text-sm font-bold text-slate-200 group-hover:text-amber-400">DASHBOARD UTAMA</span>
            </a>
        </div>
        
        <!-- Statistics Section Grid -->
        <div class="w-full max-w-4xl grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            <!-- Paket Penyedia -->
            <div class="bg-white/5 backdrop-blur-md p-6 rounded-2xl border border-white/10 shadow-lg flex flex-col justify-between">
                <span class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Jumlah Paket Penyedia</span>
                <div class="flex items-baseline mt-4 gap-2">
                    <span class="text-3xl font-extrabold text-white">124</span>
                    <span class="text-emerald-400 text-xs font-medium"><i class="fas fa-box"></i> Paket</span>
                </div>
            </div>
            
            <!-- Total Pagu -->
            <div class="bg-white/5 backdrop-blur-md p-6 rounded-2xl border border-white/10 shadow-lg flex flex-col justify-between">
                <span class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Total Pagu</span>
                <div class="mt-4">
                    <span class="text-2xl font-extrabold text-rose-400">Rp 48.230.120.000</span>
                    <p class="text-[10px] text-slate-500 mt-1">Batas Maksimal Anggaran</p>
                </div>
            </div>
            
            <!-- Total HPS -->
            <div class="bg-white/5 backdrop-blur-md p-6 rounded-2xl border border-white/10 shadow-lg flex flex-col justify-between">
                <span class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Harga Perkiraan Sendiri (HPS)</span>
                <div class="mt-4">
                    <span class="text-2xl font-extrabold text-amber-400">Rp 47.980.450.000</span>
                    <p class="text-[10px] text-slate-500 mt-1">Kalkulasi Nilai HPS Paket</p>
                </div>
            </div>
            
            <!-- Total Nilai Kontrak -->
            <div class="bg-white/5 backdrop-blur-md p-6 rounded-2xl border border-white/10 shadow-lg flex flex-col justify-between lg:col-span-2">
                <span class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Total Nilai Kontrak terealisasi</span>
                <div class="flex flex-col sm:flex-row sm:items-center justify-between mt-4 gap-4">
                    <span class="text-3xl font-extrabold text-emerald-400">Rp 45.120.900.000</span>
                    <span class="text-xs bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20 font-medium">93.8% Terkontrak</span>
                </div>
            </div>
            
            <!-- Total Efisiensi -->
            <div class="bg-white/5 backdrop-blur-md p-6 rounded-2xl border border-white/10 shadow-lg flex flex-col justify-between">
                <span class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Total Efisiensi</span>
                <div class="mt-4">
                    <span class="text-2xl font-extrabold text-teal-400">Rp 2.859.550.000</span>
                    <p class="text-[10px] text-slate-500 mt-1">Selisih Pagu & Nilai Kontrak</p>
                </div>
            </div>
        </div>
        
        <!-- FAQ Search Card -->
        <div class="w-full max-w-xl bg-white/5 backdrop-blur-md p-6 rounded-2xl border border-white/10 shadow-xl">
            <h4 class="font-bold text-lg text-slate-100 flex items-center gap-2 mb-4">
                <i class="fas fa-question-circle text-emerald-400"></i> Cari Informasi FAQ
            </h4>
            <div class="flex gap-2">
                <input id="cari" class="flex-1 bg-slate-950/40 border border-slate-700/50 rounded-xl px-4 py-2.5 text-sm text-slate-100 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition placeholder-slate-500" type="search" placeholder="Masukkan kata kunci pencarian...">
                <button onclick="handleSearch()" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-xl transition font-semibold text-sm flex items-center gap-2 shadow-lg shadow-emerald-600/20">
                    <i class="fas fa-search"></i> Cari
                </button>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="py-6 border-t border-white/5 text-center text-xs text-slate-500">
        Copyright &copy; 2022 Bagian Pengadaan Barang dan Jasa Kabupaten Sinjai
    </footer>
    
    <script>
        function handleSearch() {
            var val = document.getElementById('cari').value;
            window.location = "http://kb.sinjaikab.go.id/dilan/dashboard/faq_opd/5?cari=" + encodeURIComponent(val);
        }
        
        // Listen to Enter key
        document.getElementById('cari').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                handleSearch();
            }
        });
    </script>
</body>
</html>
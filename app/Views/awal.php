<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-950">
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
<body class="min-h-screen bg-slate-950 text-slate-100 flex flex-col font-sans relative overflow-x-hidden" style="background-image: url('<?= base_url('assets/img/bg.png') ?>'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;">
    
    <!-- Background overlay for better contrast -->
    <div class="absolute inset-0 bg-slate-950/45 pointer-events-none z-0"></div>

    <div class="relative z-10 flex-1 flex flex-col justify-center items-center px-4 py-12 md:py-16">
        <!-- Brand Section -->
        <div class="text-center mb-10 max-w-2xl">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight bg-gradient-to-r from-emerald-400 via-teal-300 to-amber-300 bg-clip-text text-transparent drop-shadow-md pb-2">
                SELAMAT DATANG
            </h1>
        </div>
        
        <!-- Action Cards Grid -->
        <div class="flex flex-col sm:flex-row items-stretch justify-center gap-6 mb-12 w-full max-w-2xl">
            <!-- Website UKPBJ Card -->
            <a href="http://ukpbj.sinjaikab.go.id/" target="_blank" class="flex-1 group relative overflow-hidden bg-slate-900/60 backdrop-blur-xl p-6 rounded-2xl border border-slate-800/80 hover:border-emerald-500/30 hover:shadow-[0_0_30px_rgba(16,185,129,0.15)] transition-all duration-300 flex flex-col items-center justify-center text-center">
                <div class="w-16 h-16 rounded-xl bg-emerald-500/10 flex items-center justify-center border border-emerald-500/20 group-hover:bg-emerald-500/20 group-hover:border-emerald-500/40 mb-3 transition duration-300">
                    <img src="<?= base_url('assets/img/logo_ukpbj.png') ?>" alt="Logo UKPBJ" class="h-10 w-10 object-contain group-hover:scale-110 transition duration-300">
                </div>
                <span class="text-xs font-bold tracking-wider text-slate-300 group-hover:text-emerald-400 transition">WEBSITE RESMI UKPBJ</span>
            </a>
            
            <!-- Dashboard Card -->
            <a href="<?= base_url('dashboard') ?>" class="flex-1 group relative overflow-hidden bg-slate-900/60 backdrop-blur-xl p-6 rounded-2xl border border-slate-800/80 hover:border-amber-500/30 hover:shadow-[0_0_30px_rgba(245,158,11,0.15)] transition-all duration-300 flex flex-col items-center justify-center text-center">
                <div class="w-16 h-16 rounded-xl bg-amber-500/10 flex items-center justify-center border border-amber-500/20 group-hover:bg-amber-500/20 group-hover:border-amber-500/40 mb-3 transition duration-300">
                    <img src="<?= base_url('assets/img/logo_utama.png') ?>" alt="Logo Utama" class="h-10 w-10 object-contain group-hover:scale-110 transition duration-300">
                </div>
                <span class="text-xs font-bold tracking-wider text-slate-300 group-hover:text-amber-400 transition">E-CENTER OF EXCELLENT</span>
            </a>
        </div>
        
        <!-- Statistics Section Grid -->
        <div class="w-full max-w-4xl grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            <!-- Paket Penyedia -->
            <div class="group relative overflow-hidden bg-slate-900/60 backdrop-blur-xl p-6 rounded-2xl border border-slate-800/80 hover:border-slate-700/80 transition-all duration-300 shadow-xl flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Paket Penyedia</span>
                    <div class="w-8 h-8 rounded-lg bg-emerald-500/10 flex items-center justify-center border border-emerald-500/20 text-emerald-400">
                        <i class="fas fa-boxes text-sm"></i>
                    </div>
                </div>
                <div class="mt-6 flex items-baseline gap-2">
                    <span class="text-3xl font-bold text-white tracking-tight">124</span>
                    <span class="text-emerald-400 text-xs font-medium bg-emerald-500/10 px-2 py-0.5 rounded-full border border-emerald-500/10">Paket</span>
                </div>
            </div>
            
            <!-- Total Pagu -->
            <div class="group relative overflow-hidden bg-slate-900/60 backdrop-blur-xl p-6 rounded-2xl border border-slate-800/80 hover:border-slate-700/80 transition-all duration-300 shadow-xl flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Total Pagu</span>
                    <div class="w-8 h-8 rounded-lg bg-rose-500/10 flex items-center justify-center border border-rose-500/20 text-rose-400">
                        <i class="fas fa-wallet text-sm"></i>
                    </div>
                </div>
                <div class="mt-6">
                    <span class="text-2xl font-bold text-rose-400 tracking-tight">Rp 48.230.120.000</span>
                    <p class="text-[10px] text-slate-500 mt-1.5 flex items-center gap-1"><i class="fas fa-info-circle text-[8px]"></i> Batas Maksimal Anggaran</p>
                </div>
            </div>
            
            <!-- Total HPS -->
            <div class="group relative overflow-hidden bg-slate-900/60 backdrop-blur-xl p-6 rounded-2xl border border-slate-800/80 hover:border-slate-700/80 transition-all duration-300 shadow-xl flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Harga Perkiraan Sendiri (HPS)</span>
                    <div class="w-8 h-8 rounded-lg bg-amber-500/10 flex items-center justify-center border border-amber-500/20 text-amber-400">
                        <i class="fas fa-calculator text-sm"></i>
                    </div>
                </div>
                <div class="mt-6">
                    <span class="text-2xl font-bold text-amber-400 tracking-tight">Rp 47.980.450.000</span>
                    <p class="text-[10px] text-slate-500 mt-1.5 flex items-center gap-1"><i class="fas fa-info-circle text-[8px]"></i> Kalkulasi Nilai HPS Paket</p>
                </div>
            </div>
            
            <!-- Total Nilai Kontrak -->
            <div class="group relative overflow-hidden bg-slate-900/60 backdrop-blur-xl p-6 rounded-2xl border border-slate-800/80 hover:border-slate-700/80 transition-all duration-300 shadow-xl flex flex-col justify-between lg:col-span-2">
                <div class="flex items-center justify-between">
                    <span class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Total Nilai Kontrak Terealisasi</span>
                    <div class="w-8 h-8 rounded-lg bg-sky-500/10 flex items-center justify-center border border-sky-500/20 text-sky-400">
                        <i class="fas fa-file-signature text-sm"></i>
                    </div>
                </div>
                <div class="mt-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <span class="text-3xl font-bold text-sky-400 tracking-tight">Rp 45.120.900.000</span>
                    <span class="text-[10px] bg-emerald-500/10 text-emerald-400 px-2.5 py-1 rounded-full border border-emerald-500/20 font-semibold self-start sm:self-center flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        93.8% Terkontrak
                    </span>
                </div>
            </div>
            
            <!-- Total Efisiensi -->
            <div class="group relative overflow-hidden bg-slate-900/60 backdrop-blur-xl p-6 rounded-2xl border border-slate-800/80 hover:border-slate-700/80 transition-all duration-300 shadow-xl flex flex-col justify-between">
                <div class="flex items-center justify-between">
                    <span class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Total Efisiensi</span>
                    <div class="w-8 h-8 rounded-lg bg-teal-500/10 flex items-center justify-center border border-teal-500/20 text-teal-400">
                        <i class="fas fa-piggy-bank text-sm"></i>
                    </div>
                </div>
                <div class="mt-6">
                    <span class="text-2xl font-bold text-teal-400 tracking-tight">Rp 2.859.550.000</span>
                    <p class="text-[10px] text-slate-500 mt-1.5 flex items-center gap-1"><i class="fas fa-info-circle text-[8px]"></i> Selisih Pagu & Nilai Kontrak</p>
                </div>
            </div>
        </div>
        
        <!-- FAQ Search Card -->
        <div class="w-full max-w-xl bg-slate-900/60 backdrop-blur-xl p-6 rounded-2xl border border-slate-800/80 shadow-2xl">
            <h4 class="font-bold text-lg text-white flex items-center gap-2.5 mb-4">
                <span class="flex items-center justify-center w-7 h-7 rounded-lg bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                    <i class="fas fa-question-circle text-sm"></i>
                </span>
                Cari Informasi FAQ
            </h4>
            <div class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                    <input id="cari" class="w-full bg-slate-950/60 border border-slate-800 rounded-xl pl-11 pr-4 py-3 text-sm text-slate-100 placeholder-slate-500 focus:outline-none focus:border-emerald-500/70 focus:ring-1 focus:ring-emerald-500/50 transition duration-300" type="search" placeholder="Masukkan kata kunci pencarian...">
                </div>
                <button onclick="handleSearch()" class="bg-emerald-600 hover:bg-emerald-500 text-white px-6 py-3 rounded-xl transition duration-300 font-semibold text-sm flex items-center justify-center gap-2 shadow-lg shadow-emerald-900/25 active:scale-95">
                    Cari
                </button>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="relative z-10 py-6 border-t border-white/5 text-center text-xs text-slate-500">
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
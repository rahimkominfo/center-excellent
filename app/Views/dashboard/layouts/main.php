<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->renderSection('title') ?> - PBJ Penilaian</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            850: '#14532d',
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Google Font: Outfit -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        
        body {
            background-image: url('<?= base_url('assets/img/bg.png') ?>');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>
    <?= $this->renderSection('styles') ?>
</head>
<body class="h-full flex flex-col font-sans antialiased text-slate-800">
    
    <!-- Top Navbar (No Sidebar layout for Dashboard) -->
    <header class="h-16 border-b border-slate-200 bg-white/80 backdrop-blur-md sticky top-0 flex items-center justify-between px-6 z-30 shadow-sm shadow-slate-100/40">
        <!-- Top-Left Corner: Login/Logout Icon and User Name -->
        <div class="flex items-center gap-3">
            <?php if (session()->get('is_logged_in')) : ?>
                <a href="<?= base_url('logout') ?>" class="flex items-center gap-2 text-rose-600 hover:text-rose-700 font-semibold text-sm transition bg-rose-50 hover:bg-rose-100/70 px-3.5 py-2 rounded-xl border border-rose-100" title="Logout">
                    <i class="fas fa-sign-out-alt text-base"></i>
                    <span class="hidden sm:inline">Keluar</span>
                </a>
                <span class="text-sm font-semibold text-slate-700 bg-slate-100 border border-slate-200/80 px-3.5 py-2 rounded-xl flex items-center gap-2">
                    <i class="fas fa-user text-slate-400 text-xs"></i>
                    <span><?= esc(session()->get('nama') ?? 'Administrator') ?></span>
                </span>
            <?php else : ?>
                <a href="<?= base_url('login') ?>" class="flex items-center gap-2 text-emerald-600 hover:text-emerald-700 font-semibold text-sm transition bg-emerald-50 hover:bg-emerald-100/70 px-3.5 py-2 rounded-xl border border-emerald-100" title="Login">
                    <i class="fas fa-sign-in-alt text-base"></i>
                    <span>Masuk</span>
                </a>
            <?php endif; ?>
        </div>

        <!-- Top-Right: Quick Navigation for Dashboard -->
        <div class="flex items-center gap-2">
            <!-- Brand emblem / link to dashboard -->
            <a href="<?= base_url('dashboard') ?>" class="flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-50 border border-slate-100 hover:bg-slate-100 transition text-slate-700 font-semibold text-sm">
                <i class="fas fa-chart-pie text-emerald-500"></i>
                <span>Dashboard Utama</span>
            </a>
            
            <!-- Quick links dropdown / menu -->
            <?php if ((string)session()->get('nip') === '198202272005021004') : ?>
                <a href="<?= base_url('kontrak') ?>" class="flex items-center gap-2 px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm transition shadow-sm shadow-emerald-500/10">
                    <i class="fas fa-file-contract"></i>
                    <span class="hidden md:inline">Kelola Kontrak</span>
                </a>
            <?php endif; ?>
        </div>
    </header>
    
    <!-- Main content area -->
    <main class="flex-1 p-6 md:p-8 bg-slate-50/50">
        <?= $this->renderSection('content') ?>
    </main>
    
    <!-- Footer -->
    <?php 
        $uri = service('uri');
        $isDashboardHome = ($uri->getTotalSegments() === 1 && $uri->getSegment(1) === 'dashboard');
        if (!$isDashboardHome) : 
    ?>
    <footer class="bg-white border-t border-slate-200 py-4 px-6 text-center text-xs text-slate-500">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-2 max-w-7xl mx-auto">
            <span>Copyright &copy; 2022 <strong>Bagian Pengadaan Barang dan Jasa Kabupaten Sinjai</strong>.</span>
            <span class="text-slate-400">Versi 1.0 (Tailwind Prototype)</span>
        </div>
    </footer>
    <?php endif; ?>
    
    <!-- Global Scripts -->
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>

<?php
$uri = service('uri');
$segment1 = $uri->getSegment(1);
?>
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
    </style>
    <?= $this->renderSection('styles') ?>
</head>
<body class="h-full flex flex-col font-sans antialiased text-slate-800">
    
    <!-- Sidebar Mobile Drawer Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>
    
    <!-- Left Sidebar for desktop -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 w-64 bg-slate-900 border-r border-slate-800 flex flex-col z-50 transition-transform duration-300 -translate-x-full lg:translate-x-0">
        <!-- Brand link -->
        <div class="h-16 flex items-center px-6 border-b border-slate-800 gap-3">
            <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center text-white font-bold shadow-md shadow-emerald-500/20">
                <i class="fas fa-clipboard-check"></i>
            </div>
            <span class="text-white font-bold text-lg tracking-wide">Penilaian PBJ</span>
        </div>
        
        <!-- Navigation menu -->
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto custom-scrollbar">
            <div>
                <a href="<?= base_url('dashboard') ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition duration-200 <?= ($segment1 === 'dashboard') ? 'bg-emerald-600/10 text-emerald-400 border-l-4 border-emerald-500' : 'hover:bg-slate-800 text-slate-400 hover:text-slate-200' ?>">
                    <i class="fas fa-chart-pie text-lg"></i>
                    <span>Dashboard</span>
                </a>
            </div>
            
            <?php if ((string)session()->get('nip') === '198202272005021004') : ?>
            <div class="pt-4">
                <p class="px-4 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Dokumen</p>
                <div class="space-y-1">
                    <a href="<?= base_url('kontrak') ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition duration-200 <?= ($segment1 === 'kontrak') ? 'bg-emerald-600/10 text-emerald-400 border-l-4 border-emerald-500' : 'hover:bg-slate-800 text-slate-400 hover:text-slate-200' ?>">
                        <i class="fas fa-file-contract text-lg"></i>
                        <span>Kontrak</span>
                    </a>
                    <a href="<?= base_url('penilaian') ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition duration-200 <?= ($segment1 === 'penilaian') ? 'bg-emerald-600/10 text-emerald-400 border-l-4 border-emerald-500' : 'hover:bg-slate-800 text-slate-400 hover:text-slate-200' ?>">
                        <i class="fas fa-clipboard-list text-lg"></i>
                        <span>Data PBJ</span>
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </nav>
        
        <!-- User profile section in sidebar footer -->
        <div class="p-4 border-t border-slate-800 bg-slate-950/40">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-emerald-600 flex items-center justify-center text-white font-semibold text-sm">
                    ADM
                </div>
                <div class="flex-1 overflow-hidden">
                    <p class="text-sm font-semibold text-white truncate"><?= esc(session()->get('nama') ?? 'Administrator') ?></p>
                    <p class="text-xs text-slate-500 truncate">NIP. <?= esc(session()->get('nip') ?? '198202272005021004') ?></p>
                </div>
                <a href="<?= base_url('logout') ?>" class="text-slate-400 hover:text-rose-400 transition" title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>
    </aside>
    
    <!-- Main content wrapper -->
    <div class="lg:pl-64 flex flex-col flex-1 min-h-screen">
        
        <!-- Top Navbar -->
        <header class="h-16 border-b border-slate-200 bg-white/80 backdrop-blur-md sticky top-0 flex items-center justify-between px-6 z-30 shadow-sm shadow-slate-100/40">
            <button class="lg:hidden text-slate-600 hover:text-slate-900 focus:outline-none" onclick="toggleSidebar()">
                <i class="fas fa-bars text-xl"></i>
            </button>
            
            <div class="flex items-center gap-3 ml-auto">
                <div class="relative group">
                    <button class="flex items-center gap-2 text-slate-700 hover:text-slate-900 font-medium px-3 py-1.5 rounded-lg hover:bg-slate-50 transition" onclick="toggleUserDropdown()">
                        <i class="fas fa-user-circle text-xl text-slate-400"></i>
                        <span class="hidden md:inline text-sm">Menu Pengguna</span>
                        <i class="fas fa-chevron-down text-xs text-slate-400"></i>
                    </button>
                    <!-- Dropdown menu -->
                    <div id="user-dropdown" class="absolute right-0 mt-2 w-56 rounded-xl bg-white border border-slate-100 shadow-lg py-2 hidden flex-col z-50 animate-in fade-in slide-in-from-top-2 duration-150">
                        <a href="<?= base_url('dashboard/kontrak_ppk') ?>" class="px-4 py-2 text-sm text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 flex items-center gap-2">
                            <i class="fas fa-star text-slate-400"></i> Penilaian PPK
                        </a>
                        <a href="<?= base_url('dashboard/lap_monitoring') ?>" class="px-4 py-2 text-sm text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 flex items-center gap-2">
                            <i class="fas fa-desktop text-slate-400"></i> Laporan Monitoring
                        </a>
                        <a href="<?= base_url('dashboard/lap_tepra') ?>" class="px-4 py-2 text-sm text-slate-700 hover:bg-emerald-50 hover:text-emerald-700 flex items-center gap-2">
                            <i class="fas fa-file-invoice text-slate-400"></i> Laporan Tepra
                        </a>
                        <div class="border-t border-slate-100 my-1"></div>
                        <a href="<?= base_url('login') ?>" class="px-4 py-2 text-sm text-rose-600 hover:bg-rose-50 flex items-center gap-2">
                            <i class="fas fa-sign-out-alt"></i> Keluar
                        </a>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Main content area -->
        <main class="flex-1 p-6 md:p-8 bg-slate-50/50">
            <?= $this->renderSection('content') ?>
        </main>
        
        <!-- Footer -->
        <footer class="bg-white border-t border-slate-200 py-4 px-6 text-center text-xs text-slate-500">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-2 max-w-7xl mx-auto">
                <span>Copyright &copy; 2022 <strong>Bagian Pengadaan Barang dan Jasa Kabupaten Sinjai</strong>.</span>
                <span class="text-slate-400">Versi 1.0 (Tailwind Prototype)</span>
            </div>
        </footer>
        
    </div>
    
    <!-- Script actions -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
        
        function toggleUserDropdown() {
            const dropdown = document.getElementById('user-dropdown');
            dropdown.classList.toggle('hidden');
            dropdown.classList.toggle('flex');
        }
        
        // Close dropdown when clicking outside
        window.addEventListener('click', function(e) {
            const dropdown = document.getElementById('user-dropdown');
            if (dropdown) {
                const button = dropdown.previousElementSibling;
                if (button && !dropdown.contains(e.target) && !button.contains(e.target)) {
                    dropdown.classList.add('hidden');
                    dropdown.classList.remove('flex');
                }
            }
        });
        
        function goBack() {
            window.history.back();
        }
    </script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>

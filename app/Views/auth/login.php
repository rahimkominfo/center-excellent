<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login - PBJ Penilaian</title>
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
<body class="h-full bg-gradient-to-tr from-slate-950 via-slate-900 to-emerald-950 flex flex-col justify-center py-12 sm:px-6 lg:px-8 font-sans">
    
    <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
        <!-- Logo Icon -->
        <div class="mx-auto w-16 h-16 flex items-center justify-center">
            <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo" class="w-16 h-16 object-contain">
        </div>
        <h2 class="mt-6 text-center text-3xl font-extrabold text-slate-100">
            Halaman Login
        </h2>
        <p class="mt-2 text-center text-sm text-slate-400 font-medium">
            Sistem Informasi Penilaian Kinerja Penyedia & Monitoring
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md px-4">
        <div class="bg-slate-900/60 backdrop-blur-md py-8 px-6 shadow-2xl rounded-2xl border border-slate-800/80 sm:px-10">
            
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="mb-4 animate-in fade-in duration-200">
                    <?= session()->getFlashdata('pesan') ?>
                </div>
            <?php endif; ?>

            <?php if (isset($validation) && $validation->getErrors()) : ?>
                <div class="mb-4 p-3 bg-rose-500/20 border border-rose-500/40 text-rose-200 rounded-xl text-[11px] font-semibold animate-in fade-in duration-200">
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif; ?>

            <form class="space-y-6" action="<?= base_url('login') ?>" method="POST">
                <div>
                    <label for="nip" class="block text-sm font-semibold text-slate-300">
                        Nomor Induk Pegawai (NIP)
                    </label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                            <i class="fas fa-user-tag text-sm"></i>
                        </div>
                        <input id="nip" name="nip" type="text" required autofocus
                            class="block w-full pl-10 pr-4 py-2.5 bg-slate-950/40 border border-slate-700/60 rounded-xl text-slate-200 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 transition text-sm"
                            placeholder="Masukkan NIP!">
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-300">
                        Kata Sandi / Password
                    </label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                            <i class="fas fa-key text-sm"></i>
                        </div>
                        <input id="password" name="password" type="password" required
                            class="block w-full pl-10 pr-4 py-2.5 bg-slate-950/40 border border-slate-700/60 rounded-xl text-slate-200 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500 transition text-sm"
                            placeholder="Password">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-900 focus:ring-emerald-500 transition duration-200 transform hover:-translate-y-[1px]">
                        Login ke Dashboard
                    </button>
                </div>
            </form>
            
            <div class="mt-6 border-t border-slate-800 pt-6 text-center">
                <a href="<?= base_url() ?>" class="text-xs font-semibold text-slate-400 hover:text-emerald-400 transition flex items-center justify-center gap-1.5">
                    <i class="fas fa-arrow-left"></i> Kembali ke Halaman Utama
                </a>
            </div>

        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Desa Simpur</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .glass-nav {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="bg-gray-50 text-slate-800 antialiased selection:bg-emerald-500 selection:text-white">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 transition-all duration-300 glass-nav shadow-sm top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center cursor-pointer" onclick="window.location='{{ url('/') }}'">
                    <img src="{{ asset('assets/logo-pemalang.png') }}" alt="Logo" class="h-10 w-auto mr-3">
                    <div>
                        <span class="text-2xl font-bold text-gray-900 tracking-tight">SIMPUR</span>
                        <p class="text-xs text-emerald-600 font-medium tracking-wider uppercase hidden sm:block">Desa Simpur Digital</p>
                    </div>
                </div>

                <!-- Menu -->
                    <div class="hidden md:flex space-x-2 items-center">
                        @if(request()->is('dashboard', 'admin/*'))
                            <!-- Menu Khusus Halaman Admin -->
                            <a href="{{ route('dashboard') }}" class="text-sm font-semibold {{ request()->is('dashboard') ? 'text-emerald-600' : 'text-gray-600' }} hover:text-emerald-600 transition-colors px-3 py-2">Dashboard</a>
                            <a href="{{ route('admin.surat.index') }}" class="text-sm font-semibold {{ request()->is('admin/surat*') ? 'text-emerald-600' : 'text-gray-600' }} hover:text-emerald-600 transition-colors px-3 py-2">Surat Masuk</a>
                            <a href="{{ route('admin.berita.index') }}" class="text-sm font-semibold {{ request()->is('admin/berita*') ? 'text-emerald-600' : 'text-gray-600' }} hover:text-emerald-600 transition-colors px-3 py-2">Kelola Berita</a>
                            <a href="{{ route('logout') }}" class="text-sm font-semibold text-red-500 hover:bg-red-50 px-3 py-2 rounded-lg transition-colors ml-2">Logout</a>
                        @else
                            <!-- Menu Khusus Halaman Publik (Beranda, Profil, Berita) -->
                            <a href="{{ url('/') }}" class="text-sm font-semibold text-gray-600 hover:text-emerald-600 transition-colors px-3 py-2">Beranda</a>
                            <a href="{{ route('profil.desa') }}" class="text-sm font-semibold text-gray-600 hover:text-emerald-600 transition-colors px-3 py-2">Profil Desa</a>
                            <a href="{{ route('berita.index') }}" class="text-sm font-semibold text-gray-600 hover:text-emerald-600 transition-colors px-3 py-2">Berita</a>
                            <a href="{{ route('pengajuan.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-5 py-2.5 rounded-full text-sm font-medium transition-all shadow-lg shadow-emerald-600/30 hover:shadow-xl ml-2">
                                Ajukan Surat
                            </a>
                        @endif
                    </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center py-8 text-gray-400 text-sm mt-12 border-t border-gray-200">
        <p>© 2026 Pemerintah Desa Simpur, Pemalang</p>
    </footer>

</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Petugas - SIMPUR</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-gray-900 h-screen flex items-center justify-center overflow-hidden relative">

    <!-- Background -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('img/curug.jpg') }}" class="w-full h-full object-cover opacity-40 blur-sm" alt="Background">
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-emerald-900/40 to-gray-900/80"></div>
    </div>

    <!-- Login Card -->
    <div class="relative z-10 w-full max-w-md px-6">
        <div class="bg-white/10 backdrop-blur-xl border border-white/20 p-8 rounded-3xl shadow-2xl">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-white tracking-tight">Login Petugas</h1>
                <p class="text-gray-300 text-sm mt-2">Masuk untuk mengelola administrasi desa</p>
            </div>

            @if(session('error'))
                <div class="mb-4 bg-red-500/10 border border-red-500/50 text-red-200 px-4 py-3 rounded-xl text-sm flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 ml-1">Email</label>
                    <input type="email" name="email" class="w-full px-5 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white/10 transition-all font-medium" placeholder="admin@simpur.desa.id" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 ml-1">Password</label>
                    <input type="password" name="password" class="w-full px-5 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:bg-white/10 transition-all font-medium" placeholder="••••••••" required>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-4 rounded-xl shadow-lg shadow-emerald-900/50 transition-all transform hover:-translate-y-1">
                        Masuk Dashboard
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center">
                <a href="{{ url('/') }}" class="text-sm text-gray-400 hover:text-white transition-colors">
                    &larr; Kembali ke Beranda
                </a>
            </div>
        </div>
        
        <p class="text-center text-gray-500 text-xs mt-8">
            &copy; 2026 Sistem Informasi Desa Simpur
        </p>
    </div>

</body>
</html>

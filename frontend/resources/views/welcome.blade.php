<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Desa Simpur</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="text-center px-4">
            <h1 class="text-6xl font-bold text-gray-900 mb-4">SIMPUR</h1>
            <p class="text-2xl text-gray-600 mb-2">Sistem Informasi Desa Simpur</p>
            <p class="text-lg text-gray-500 mb-8">Platform Pelayanan Publik Digital</p>
            
            <div class="flex gap-4 justify-center flex-wrap mb-8">
                <a href="{{ url('/profil-desa') }}" class="px-6 py-3 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">Profil Desa</a>
                <a href="{{ url('/berita') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Berita</a>
                <a href="{{ url('/pengajuan') }}" class="px-6 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700">Ajukan Surat</a>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow mt-8 max-w-md mx-auto">
                <h3 class="font-bold text-gray-900 mb-2">Status Sistem:</h3>
                <p class="text-sm text-gray-600">Backend: <span class="font-mono text-emerald-600">{{ env('BACKEND_URL', 'Tidak dikonfigurasi') }}</span></p>
                <p class="text-sm text-gray-600 mt-2">Port: <span class="font-mono text-blue-600">{{ env('PORT', '8080') }}</span></p>
            </div>
        </div>
    </div>
</body>
</html>

@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="relative min-h-[115vh] flex items-center justify-center overflow-hidden bg-gray-900 -mt-20">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
             <img src="{{ asset('img/curug.jpg') }}" class="w-full h-full object-cover opacity-60" alt="Curug Desa Simpur">
             <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center pt-24">
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-white mb-6 leading-tight drop-shadow-md">
                Urus Surat Desa <br>
                <span class="text-emerald-400">Tanpa Antri</span>
            </h1>
            <p class="mt-4 text-xl text-gray-200 max-w-2xl mx-auto mb-10 leading-relaxed font-light drop-shadow-sm">
                Platform pelayanan publik digital Desa Simpur untuk memudahkan warga dalam pengajuan administrasi kependudukan secara cepat, transparan, dan efisien.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('pengajuan.create') }}" class="px-8 py-4 bg-emerald-600 text-white font-semibold rounded-xl shadow-xl shadow-emerald-900/30 hover:bg-emerald-500 hover:scale-105 transition-all duration-300 border border-emerald-500">
                    Mulai Pengajuan &rarr; 
                </a>
                <a href="#fitur" class="px-8 py-4 bg-white/10 backdrop-blur-md text-white border border-white/20 font-semibold rounded-xl hover:bg-white/20 transition-all">
                    Pelajari Alur
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="bg-emerald-900 hero-pattern py-12 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-900 to-transparent"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                <div class="p-6">
                    <div class="text-4xl font-bold mb-2">Efisien</div>
                    <div class="text-emerald-200 text-sm font-medium">Layanan Digital</div>
                </div>
                <div class="p-6 border-l border-emerald-800">
                    <div class="text-4xl font-bold mb-2">Lengkap</div>
                    <div class="text-emerald-200 text-sm font-medium">Jenis Pengajuan Surat</div>
                </div>
                <div class="p-6 border-l border-emerald-800">
                    <div class="text-4xl font-bold mb-2">Terpadu</div>
                    <div class="text-emerald-200 text-sm font-medium">Proses Verifikasi</div>
                </div>
                <div class="p-6 border-l border-emerald-800">
                    <div class="text-4xl font-bold mb-2">Privasi</div>
                    <div class="text-emerald-200 text-sm font-medium">Keamanan Data Warga</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="fitur" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-emerald-600 font-bold tracking-widest uppercase text-sm">Keunggulan</span>
                <h2 class="text-3xl font-bold text-gray-900 mt-2">Mengapa Menggunakan SIMPUR?</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                    <div class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-emerald-600 transition-colors">
                        <svg class="w-7 h-7 text-emerald-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Privasi Terjaga</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Data kependudukan Anda dilindungi dengan enkripsi aman. Hanya petugas berwenang yang dapat mengakses.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                    <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-blue-600 transition-colors">
                        <svg class="w-7 h-7 text-blue-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Real-time Tracking</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Tidak perlu bertanya-tanya. Pantau status surat Anda (Diajukan, Diproses, Selesai) langsung dari sistem.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                    <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-orange-600 transition-colors">
                        <svg class="w-7 h-7 text-orange-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Arsip Digital</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Surat yang telah terbit tersimpan secara digital dan dapat diunduh kapan saja Anda butuhkan.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-20 bg-gray-900 text-center relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-10"></div>
        <div class="max-w-4xl mx-auto px-4 relative z-10">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Siap Mengurus Dokumen?</h2>
            <p class="text-gray-400 text-lg mb-10 max-w-2xl mx-auto">
                Hemat waktu Anda. Ajukan surat sekarang juga dan ambil di balai desa setelah mendapatkan notifikasi selesai.
            </p>
            <a href="{{ route('pengajuan.create') }}" class="inline-block bg-white text-gray-900 font-bold px-10 py-4 rounded-full hover:bg-emerald-50 transition-colors shadow-lg">
                Buat Pengajuan Sekarang
            </a>
        </div>
    </div>

    <!-- Footer -->
    <!-- Managed by Layout -->

@endsection

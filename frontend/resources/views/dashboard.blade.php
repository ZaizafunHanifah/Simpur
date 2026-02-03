@extends('layouts.app')

@section('content')
<div class="pt-28 pb-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-10 flex justify-between items-end">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Dashboard Overview</h2>
            <p class="text-gray-500 mt-1">Selamat datang kembali, Admin Desa.</p>
        </div>
        <div class="bg-emerald-100 text-emerald-800 px-4 py-2 rounded-lg text-sm font-medium">
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    <!-- Top Stats: Primary Entities -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
        <!-- Card: Total Warga -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center relative overflow-hidden group">
            <div class="absolute top-0 right-0 -mt-2 -mr-2 w-16 h-16 bg-blue-50 rounded-full opacity-50 blur-xl group-hover:bg-blue-100 transition-colors"></div>
            <div class="bg-blue-50 text-blue-600 p-4 rounded-xl mr-5 relative z-10">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div class="relative z-10">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest uppercase">Total Kependudukan</p>
                <h3 class="text-3xl font-bold text-gray-900">{{ $wargaCount }} <span class="text-sm font-medium text-gray-400 uppercase ml-1 tracking-normal">Jiwa</span></h3>
            </div>
            <a href="{{ route('admin.warga.index') }}" class="ml-auto p-2 text-gray-300 hover:text-blue-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>

        <!-- Card: Total Surat -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center relative overflow-hidden group">
            <div class="absolute top-0 right-0 -mt-2 -mr-2 w-16 h-16 bg-emerald-50 rounded-full opacity-50 blur-xl group-hover:bg-emerald-100 transition-colors"></div>
            <div class="bg-emerald-50 text-emerald-600 p-4 rounded-xl mr-5 relative z-10">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <div class="relative z-10">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest uppercase">Akumulasi Pengajuan</p>
                <h3 class="text-3xl font-bold text-gray-900">{{ $suratCount }} <span class="text-sm font-medium text-gray-400 uppercase ml-1 tracking-normal">Berkas</span></h3>
            </div>
            <a href="{{ route('admin.surat.index') }}" class="ml-auto p-2 text-gray-300 hover:text-emerald-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
    </div>

    <!-- Status Breakdown Grid -->
    <h4 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4">Breakdown Status Surat</h4>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
        <!-- Diajukan -->
        <div class="bg-white rounded-2xl border border-gray-100 p-5 shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-gray-50 text-gray-500 rounded-lg flex items-center justify-center group-hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span class="text-2xl font-bold text-gray-900">{{ $statusCounts['diajukan'] }}</span>
            </div>
            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider uppercase">Baru/Antri</p>
        </div>

        <!-- Diverifikasi (Need Print/Sign) -->
        <div class="bg-white rounded-2xl border border-blue-100 p-5 shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center group-hover:bg-blue-100 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                </div>
                <span class="text-2xl font-bold text-blue-700">{{ $statusCounts['diverifikasi'] }}</span>
            </div>
            <p class="text-xs font-bold text-blue-500 uppercase tracking-wider uppercase">Proses TTD</p>
        </div>

        <!-- Selesai -->
        <div class="bg-white rounded-2xl border border-emerald-100 p-5 shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-lg flex items-center justify-center group-hover:bg-emerald-100 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <span class="text-2xl font-bold text-emerald-700">{{ $statusCounts['selesai'] }}</span>
            </div>
            <p class="text-xs font-bold text-emerald-500 uppercase tracking-wider uppercase">Selesai</p>
        </div>

        <!-- Ditolak -->
        <div class="bg-white rounded-2xl border border-red-100 p-5 shadow-sm hover:shadow-md transition-shadow group">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-red-50 text-red-500 rounded-lg flex items-center justify-center group-hover:bg-red-100 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </div>
                <span class="text-2xl font-bold text-red-700">{{ $statusCounts['ditolak'] }}</span>
            </div>
            <p class="text-xs font-bold text-red-500 uppercase tracking-wider uppercase">Ditolak</p>
        </div>
    </div>

    <!-- Quick Actions Banner -->
    <div class="bg-gradient-to-r from-emerald-900 to-teal-800 rounded-3xl p-8 md:p-12 relative overflow-hidden text-white shadow-2xl">
        <div class="relative z-10 max-w-3xl">
            <h3 class="text-3xl font-bold mb-4">Akses Cepat Admin</h3>
            <p class="text-emerald-100 mb-8 text-lg font-light leading-relaxed">
                Kelola surat masuk, verifikasi data warga, dan pantau aktivitas desa dalam satu panel terintegrasi.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('admin.surat.index') }}" class="bg-white text-emerald-900 px-6 py-3.5 rounded-xl font-bold hover:bg-emerald-50 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    Kelola Surat Masuk
                </a>
                <a href="{{ route('admin.warga.create') }}" class="bg-emerald-800/50 backdrop-blur border border-emerald-500/30 text-white px-6 py-3.5 rounded-xl font-bold hover:bg-emerald-700/50 transition-all">
                    Tambah Warga Baru
                </a>
                <a href="{{ route('admin.berita.create') }}" class="bg-emerald-800/50 backdrop-blur border border-emerald-500/30 text-white px-6 py-3.5 rounded-xl font-bold hover:bg-emerald-700/50 transition-all">
                    Input Berita Terkini
                </a>
            </div>
        </div>
        
        <!-- Decoration Icons -->
        <div class="absolute right-0 bottom-0 opacity-10 transform translate-x-10 translate-y-10">
            <svg class="w-80 h-80" fill="currentColor" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
        </div>
        <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500 rounded-full mix-blend-overlay filter blur-3xl opacity-20 transform translate-x-1/2 -translate-y-1/2"></div>
    </div>
</div>
@endsection

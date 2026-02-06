@extends('layouts.app')

@section('content')
<!-- Header Page -->
<div class="relative pt-52 pb-32 overflow-hidden bg-emerald-900 -mt-20">
    <!-- Decor Background -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-900 via-teal-900 to-gray-900 opacity-90"></div>
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-10"></div>
        
        <!-- Animated Blobs -->
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-96 h-96 bg-emerald-500 rounded-full mix-blend-overlay filter blur-3xl opacity-20 animate-pulse"></div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-96 h-96 bg-teal-500 rounded-full mix-blend-overlay filter blur-3xl opacity-20"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <span class="inline-block py-1 px-3 rounded-full bg-emerald-800/50 border border-emerald-700 text-emerald-300 font-semibold tracking-wider uppercase text-xs mb-4 backdrop-blur-sm">Kabar Desa</span>
        <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-6 tracking-tight drop-shadow-sm">Berita & Informasi Terkini</h1>
        <p class="text-xl text-emerald-100 max-w-2xl mx-auto leading-relaxed font-light">
            Update terbaru seputar kegiatan desa, pembangunan, dan informasi penting lainnya yang dikurasi dari berbagai sumber terpercaya.
        </p>
    </div>
</div>

<!-- News Grid -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24 -mt-10 relative z-20">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        @foreach($berita as $item)
        <a href="{{ $item['link'] }}" target="_blank" class="group bg-white rounded-2xl overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-gray-100 flex flex-col h-full">
            <div class="relative h-48 overflow-hidden">
                <img src="{{ $item['gambar'] ?? asset('img/curug.jpg') }}" alt="News" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-gray-800 shadow-sm">
                    {{ $item['sumber'] ?? 'Info Desa' }}
                </div>
            </div>
            <div class="p-6 flex-1 flex flex-col">
                <div class="text-xs text-emerald-600 font-semibold mb-2 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ \Carbon\Carbon::parse($item['created_at'])->diffForHumans() }}
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-emerald-600 transition-colors line-clamp-2">
                    {{ $item['judul'] }}
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-4 line-clamp-3 flex-1">
                    {{ $item['deskripsi'] }}
                </p>
                <div class="text-emerald-600 font-semibold text-sm flex items-center mt-auto">
                    Baca Selengkapnya
                    <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </div>
            </div>
        </a>
        @endforeach

        @if(count($berita) == 0)
        <div class="col-span-full py-20 text-center bg-white rounded-2xl border border-dashed border-gray-300">
            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2zM14 4v4h4"></path></svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-1">Belum Ada Berita</h3>
            <p class="text-gray-500 max-w-xs mx-auto mb-6">Informasi terbaru belum tersedia atau koneksi ke server pusat sedang mengalami kendala.</p>
            <div class="text-xs text-gray-400 font-mono">
                System Info: backend unreachable. Check <code>/debug-api</code> for details.
            </div>
        </div>
        @endif

    </div>

    <!-- Pagination Mockup -->
    <div class="mt-12 flex justify-center">
        <nav class="flex space-x-2">
            <a href="#" class="px-4 py-2 border border-gray-200 rounded-lg text-gray-500 hover:bg-gray-50 bg-white">Previous</a>
            <a href="#" class="px-4 py-2 bg-emerald-600 text-white rounded-lg font-bold shadow-lg shadow-emerald-200">1</a>
            <a href="#" class="px-4 py-2 border border-gray-200 rounded-lg text-gray-500 hover:bg-gray-50 bg-white">2</a>
            <a href="#" class="px-4 py-2 border border-gray-200 rounded-lg text-gray-500 hover:bg-gray-50 bg-white">3</a>
            <span class="px-4 py-2 text-gray-400">...</span>
            <a href="#" class="px-4 py-2 border border-gray-200 rounded-lg text-gray-500 hover:bg-gray-50 bg-white">Next</a>
        </nav>
    </div>
</div>
@endsection

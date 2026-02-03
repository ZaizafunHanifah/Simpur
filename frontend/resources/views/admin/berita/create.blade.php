@extends('layouts.app')

@section('content')
<div class="pt-28 pb-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <a href="{{ route('admin.berita.index') }}" class="text-gray-500 hover:text-gray-900 font-medium transition-colors text-sm flex items-center mb-4">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar Berita
        </a>
        <h2 class="text-3xl font-bold text-gray-900">Tambah Berita Baru</h2>
        <p class="text-gray-500">Input link berita dari portal berita luar untuk dikurasi.</p>
    </div>

    @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
        <form action="{{ route('admin.berita.store') }}" method="POST">
            @csrf
            
            <div class="space-y-6">
                <!-- Judul -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Judul Berita <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200 transition-all font-bold" placeholder="Masukkan judul berita" required>
                </div>

                <!-- Link -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Link Berita <span class="text-red-500">*</span></label>
                    <input type="url" name="link" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200 transition-all font-mono text-sm" placeholder="https://..." required>
                    <p class="mt-1 text-xs text-gray-400">Pastikan link diawali dengan http:// atau https://</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Sumber -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Sumber / Media</label>
                        <input type="text" name="sumber" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200 transition-all" placeholder="Misal: Detik News, Tribun">
                    </div>

                    <!-- Gambar -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Link Gambar Thumbail (Opsional)</label>
                        <input type="url" name="gambar" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200 transition-all" placeholder="URL Foto/Gambar">
                    </div>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Ringkasan / Deskripsi Singkat</label>
                    <textarea name="deskripsi" rows="4" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200 transition-all" placeholder="Tuliskan ringkasan isi berita agar warga tertarik membaca..."></textarea>
                </div>
            </div>

            <div class="flex justify-end gap-4 border-t border-gray-100 pt-6 mt-8">
                <a href="{{ route('admin.berita.index') }}" class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-8 py-3 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700 shadow-lg shadow-emerald-200 transition-all transform hover:-translate-y-1">
                    Simpan Berita
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

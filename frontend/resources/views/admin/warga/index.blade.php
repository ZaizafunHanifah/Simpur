@extends('layouts.app')

@section('content')
<div class="pt-28 pb-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Data Warga</h2>
            <p class="text-gray-500">Manajemen data kependudukan desa.</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('dashboard') }}" class="px-4 py-2 text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                Kembali
            </a>
            <a href="{{ route('admin.warga.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition-colors font-bold shadow-lg shadow-emerald-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Warga
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider border-b border-gray-100">
                        <th class="p-6 font-semibold">NIK</th>
                        <th class="p-6 font-semibold">Nama Lengkap</th>
                        <th class="p-6 font-semibold">Jenis Kelamin</th>
                        <th class="p-6 font-semibold">Alamat</th>
                        <th class="p-6 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($warga as $item)
                    <tr class="hover:bg-gray-50 transition-colors group">
                        <td class="p-6 font-mono text-gray-600 font-medium">
                            {{ $item['nik'] }}
                        </td>
                        <td class="p-6">
                            <div class="font-bold text-gray-900">{{ $item['nama_lengkap'] }}</div>
                            <div class="text-xs text-gray-400">{{ $item['tempat_lahir'] ?? '-' }}, {{ isset($item['tanggal_lahir']) ? \Carbon\Carbon::parse($item['tanggal_lahir'])->format('d M Y') : '-' }}</div>
                        </td>
                        <td class="p-6 text-sm text-gray-600">
                            @if($item['jenis_kelamin'] == 'L')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Laki-laki
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                                    Perempuan
                                </span>
                            @endif
                        </td>
                        <td class="p-6 text-sm text-gray-600 max-w-xs truncate">
                            {{ $item['alamat'] }}
                        </td>
                        <td class="p-6 text-right">
                            <form action="{{ route('admin.warga.destroy', $item['id']) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600 transition-colors p-2 rounded-lg hover:bg-red-50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-12 text-center text-gray-400">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                <p>Belum ada data warga.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination (if applicable) -->
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex justify-end">
             <span class="text-xs text-gray-400">Menampilkan {{ count($warga) }} data terbaru</span>
        </div>
    </div>
</div>
@endsection

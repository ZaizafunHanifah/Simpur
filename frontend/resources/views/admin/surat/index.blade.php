@extends('layouts.app')

@section('content')
<div class="pt-28 pb-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Surat Masuk</h2>
            <p class="text-gray-500">Kelola pengajuan surat dari warga desa.</p>
        </div>
        <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-900 font-medium transition-colors">
            &larr; Kembali ke Dashboard
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        @if(count($surat) > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider border-b border-gray-100">
                            <th class="p-6 font-semibold">Tanggal</th>
                            <th class="p-6 font-semibold">Pemohon</th>
                            <th class="p-6 font-semibold">Jenis Surat</th>
                            <th class="p-6 font-semibold">Status</th>
                            <th class="p-6 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($surat as $item)
                        <tr class="hover:bg-gray-50 transition-colors group">
                            <td class="p-6 text-gray-500 text-sm whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($item['created_at'])->format('d M Y') }}
                                <span class="block text-xs text-gray-400">{{ \Carbon\Carbon::parse($item['created_at'])->format('H:i') }}</span>
                            </td>
                            <td class="p-6">
                                <div class="font-bold text-gray-900">{{ data_get($item, 'warga.nama_lengkap', '') }}</div>
                                <div class="text-xs text-gray-500 font-mono">{{ data_get($item, 'warga.nik', '') }}</div>
                            </td>
                            <td class="p-6 text-sm text-gray-700">
                                {{ $item['template_surat']['nama_template'] }}
                            </td>
                            <td class="p-6">
                                @if($item['status'] == 'diajukan')
                                    <span class="inline-flex px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold ring-1 ring-inset ring-gray-500/10">Baru</span>
                                @elseif($item['status'] == 'diverifikasi')
                                    <span class="inline-flex px-3 py-1 bg-yellow-50 text-yellow-700 rounded-full text-xs font-bold ring-1 ring-inset ring-yellow-600/20">Menunggu TTD</span>
                                @elseif($item['status'] == 'selesai')
                                    <span class="inline-flex px-3 py-1 bg-emerald-50 text-emerald-700 rounded-full text-xs font-bold ring-1 ring-inset ring-emerald-600/20">Selesai</span>
                                @elseif($item['status'] == 'ditolak')
                                    <span class="inline-flex px-3 py-1 bg-red-50 text-red-700 rounded-full text-xs font-bold ring-1 ring-inset ring-red-600/10">Ditolak</span>
                                @endif
                            </td>
                            <td class="p-6 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.surat.show', $item['id']) }}" class="px-3 py-1.5 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-100 transition-colors text-xs font-bold flex items-center">
                                        Detail
                                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.surat.destroy', $item['id']) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus pengajuan ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-20">
                <div class="bg-gray-50 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <h5 class="text-gray-900 font-bold text-lg">Belum ada pengajuan</h5>
                <p class="text-gray-500 text-sm">Saat ini belum ada data surat masuk dari warga.</p>
            </div>
        @endif
    </div>
</div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="pt-28 pb-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('admin.surat.index') }}" class="text-gray-500 hover:text-gray-900 font-medium transition-colors text-sm flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>

        <form action="{{ route('admin.surat.destroy', $surat['id']) }}" method="POST" onsubmit="return confirm('Hapus seluruh data pengajuan ini secara permanen?')">
            @csrf @method('DELETE')
            <button type="submit" class="text-xs font-bold text-red-400 hover:text-red-600 transition-colors flex items-center px-3 py-1.5 rounded-lg hover:bg-red-50">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                Hapus Pengajuan
            </button>
        </form>
    </div>

    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
        @if(session('error'))
            <div class="bg-red-50 border-b border-red-100 px-8 py-4 text-red-800 flex items-center">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div class="text-sm font-medium">{{ session('error') }}</div>
            </div>
        @endif

        @if(session('success'))
            <div class="bg-emerald-50 border-b border-emerald-100 px-8 py-4 text-emerald-800 flex items-center">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <div class="text-sm font-medium">{{ session('success') }}</div>
            </div>
        @endif

        <!-- Header status -->
        <div class="bg-gray-50 px-8 py-6 border-b border-gray-100 flex justify-between items-center">
            <div>
                <span class="text-xs font-bold text-gray-400 tracking-wider uppercase">Status Surat</span>
                <div class="mt-1">
                    @if($surat['status'] == 'diajukan')
                        <span class="inline-flex px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-sm font-bold">Baru Diajukan</span>
                    @elseif($surat['status'] == 'diverifikasi')
                        <span class="inline-flex px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-bold flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg> Menunggu TTD Kades
                        </span>
                    @elseif($surat['status'] == 'selesai')
                        <span class="inline-flex px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-sm font-bold flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Selesai & Terbit
                        </span>
                    @elseif($surat['status'] == 'ditolak')
                        <span class="inline-flex px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-bold">Ditolak</span>
                    @endif
                </div>
            </div>
            <div class="text-right">
                <span class="text-xs font-bold text-gray-400 tracking-wider uppercase">Diajukan Pada</span>
                <div class="text-gray-900 font-medium">{{ \Carbon\Carbon::parse($surat['created_at'])->format('d M Y, H:i') }}</div>
            </div>
        </div>

        <div class="p-8">
            <!-- Data Pemohon -->
            <div class="mb-10">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <span class="bg-emerald-100 text-emerald-600 w-8 h-8 rounded-lg flex items-center justify-center mr-3 text-sm">1</span> Data Pemohon
                </h3>
                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Nama Lengkap</label>
                        <div class="text-gray-900 font-semibold text-lg">{{ $surat['warga']['nama_lengkap'] }}</div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">NIK</label>
                        <div class="text-gray-900 font-mono text-lg tracking-wide">{{ $surat['warga']['nik'] }}</div>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Alamat</label>
                        <div class="text-gray-900">{{ $surat['warga']['alamat'] }}</div>
                    </div>
                </div>
            </div>

            <!-- Detail Surat -->
            <div class="mb-10">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <span class="bg-blue-100 text-blue-600 w-8 h-8 rounded-lg flex items-center justify-center mr-3 text-sm">2</span> Detail Surat
                </h3>
                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                    <div class="mb-6">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Jenis Surat</label>
                        <div class="text-gray-900 font-serif text-xl">{{ $surat['template_surat']['nama_template'] }}</div>
                    </div>
                    
                    @if($surat['status'] == 'selesai')
                    <div class="mb-6">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Nomor Surat Resmi</label>
                        <div class="text-emerald-700 bg-emerald-50 px-3 py-2 rounded-lg font-mono font-bold inline-block border border-emerald-100">
                            {{ $surat['nomor_surat_final'] }}
                        </div>
                    </div>
                    @endif

                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Data Input / Keperluan</label>
                        <div class="bg-white border border-gray-200 rounded-xl p-4 text-sm text-gray-700 leading-relaxed">
                            @php $input = json_decode($surat['data_input'], true); @endphp
                            @foreach($input as $key => $val)
                                <div class="mb-2 last:mb-0">
                                    <span class="font-semibold text-gray-900 capitalize">{{ str_replace('_', ' ', $key) }}:</span> 
                                    {{ $val }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4 border-t border-gray-100 pt-8 mt-4">
                @if($surat['status'] == 'diajukan')
                    <form action="{{ route('admin.surat.verify', $surat['id']) }}" method="POST" class="flex-1">
                        @csrf @method('PUT')
                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-emerald-600/30 transition-all flex items-center justify-center" onclick="return confirm('Verifikasi data ini sudah benar?')">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Verifikasi Data Valid
                        </button>
                    </form>
                    <form action="{{ route('admin.surat.reject', $surat['id']) }}" method="POST">
                        @csrf @method('PUT')
                        <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-100 font-bold py-4 px-6 rounded-xl transition-all" onclick="return confirm('Yakin ingin menolak surat ini?')">
                            Tolak
                        </button>
                    </form>

                @elseif($surat['status'] == 'diverifikasi')
                    <div class="flex flex-col gap-3 w-full">
                        <!-- Step 1: Print -->
                        <a href="{{ route('admin.surat.download', $surat['id']) }}?penandatangan_nama=PONIMAN&penandatangan_jabatan=Kepala Desa Simpur" id="downloadPdfBtn" class="w-full bg-blue-50 text-blue-600 hover:bg-blue-100 font-bold py-3 rounded-xl border border-blue-200 transition-all flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                            Download / Cetak Surat (PDF)
                        </a>

                        <!-- Pilih Penandatangan -->
                        <div class="mb-4">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Penandatangan Surat:</label>
                            <select name="signatory_data" id="signatorySelect" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200 transition-all bg-white" required onchange="updateSignatoryFields()">
                                <option value='{"nama":"PONIMAN", "jabatan":"Kepala Desa Simpur"}'>PONIMAN (Kepala Desa)</option>
                                <option value='{"nama":"PUJI", "jabatan":"Sekretaris Desa"}'>PUJI (Sekretaris Desa)</option>
                                <option value='{"nama":"ABDUL ROHMAN", "jabatan":"Kasi Pemerintahan"}'>ABDUL ROHMAN (Kasi Pemerintahan)</option>
                                <option value='{"nama":"NURDIANTO", "jabatan":"Kasi Kesejahteraan"}'>NURDIANTO (Kasi Kesejahteraan)</option>
                                <option value='{"nama":"DAROSI", "jabatan":"Kasi Pelayanan"}'>DAROSI (Kasi Pelayanan)</option>
                            </select>
                            <input type="hidden" name="penandatangan_nama" id="hiddenSignNama" value="PONIMAN">
                            <input type="hidden" name="penandatangan_jabatan" id="hiddenSignJabatan" value="Kepala Desa Simpur">
                        </div>

                        <!-- Step 2: Mark as Done -->
                        <form action="{{ route('admin.surat.sign', $surat['id']) }}" method="POST" class="w-full" id="signForm">
                            @csrf @method('PUT')
                            <input type="hidden" name="penandatangan_nama" id="formSignNama" value="PONIMAN">
                            <input type="hidden" name="penandatangan_jabatan" id="formSignJabatan" value="Kepala Desa Simpur">
                            
                            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-emerald-500/30 transition-all flex items-center justify-center" onclick="return confirm('Pastikan surat sudah dicetak dan ditandatangani basah. Lanjutkan?')">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Finalisasi & Selesaikan Surat
                            </button>
                        </form>

                        <script>
                            function updateSignatoryFields() {
                                const select = document.getElementById('signatorySelect');
                                const data = JSON.parse(select.value);
                                
                                // Update hidden inputs for FORM submit
                                document.getElementById('formSignNama').value = data.nama;
                                document.getElementById('formSignJabatan').value = data.jabatan;

                                // Update DOWNLOAD link with correct query params for Preview
                                const baseUrl = "{{ route('admin.surat.download', $surat['id']) }}";
                                const downloadBtn = document.getElementById('downloadPdfBtn');
                                downloadBtn.href = `${baseUrl}?penandatangan_nama=${encodeURIComponent(data.nama)}&penandatangan_jabatan=${encodeURIComponent(data.jabatan)}`;
                            }
                        </script>
                    </div>

                @elseif($surat['status'] == 'selesai')
                    <div class="w-full bg-green-50 border border-green-200 rounded-xl p-4 text-center">
                        <div class="text-green-800 font-bold text-lg mb-1 flex items-center justify-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Surat Selesai
                        </div>
                        <p class="text-green-600 text-sm">Surat telah dicetak dan menunggu diambil warga.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="pt-28 pb-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="text-center mb-10">
        <h2 class="text-3xl font-bold text-gray-900">Pengajuan Surat Online</h2>
        <p class="mt-2 text-gray-600">Isi formulir di bawah ini untuk mengajukan surat keterangan desa.</p>
    </div>

    <!-- Notification Area -->
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center shadow-sm">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        <div class="p-8">
            <form id="formPengajuan" action="{{ route('pengajuan.store') }}" method="POST">
                @csrf
                
                <!-- Step 1: Jenis Surat -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Surat</label>
                    <select name="template_id" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all bg-gray-50">
                        @foreach($templates as $t)
                            <option value="{{ $t->id }}">{{ $t->nama_template }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Step 2: Cek NIK -->
                <div class="bg-gray-50 rounded-xl p-6 mb-6 border border-gray-200">
                    <label class="block text-sm font-semibold text-gray-900 mb-3">Verifikasi Data Warga</label>
                    <div class="flex gap-2">
                        <input type="text" id="nikInput" class="flex-1 px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none" placeholder="Masukkan 16 Digit NIK" maxlength="16" oninput="updateCount()">
                        <button type="button" class="bg-gray-800 text-white px-6 py-3 rounded-lg hover:bg-gray-900 transition-colors font-medium shadow-lg" onclick="checkNik()">Cek Data</button>
                    </div>
                    <div class="flex justify-between mt-2 text-xs">
                        <span id="nikStatus" class="text-gray-500">Wajib diisi untuk melanjutkan.</span>
                        <span id="nikCounter" class="text-gray-400 font-mono">0/16</span>
                    </div>
                </div>

                <!-- Step 3: Form Lanjutan (Hidden) -->
                <div id="dataDiriSection" style="display: none;" class="space-y-6 animate-fade-in-up">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Nama Lengkap</label>
                            <input type="text" id="namaWarga" class="w-full px-4 py-2 bg-gray-100 border-none rounded-lg text-gray-700 font-medium" readonly>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">NIK Terdaftar</label>
                            <input type="text" id="nikWarga" class="w-full px-4 py-2 bg-gray-100 border-none rounded-lg text-gray-700 font-medium" readonly>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Keperluan / Keterangan</label>
                        <textarea name="keperluan" rows="3" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all placeholder-gray-400" placeholder="Contoh: Untuk persyaratan melamar pekerjaan di PT..." required></textarea>
                    </div>

                    <input type="hidden" name="data_input[nik]" id="hiddenNik">
                    
                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-emerald-600/30 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                        Ajukan Permohonan Surat
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Axios Script & Logic -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function updateCount() {
        const nik = document.getElementById('nikInput').value;
        document.getElementById('nikCounter').innerText = nik.length + '/16';
    }

    async function checkNik() {
        const nik = document.getElementById('nikInput').value;
        const statusText = document.getElementById('nikStatus');
        const section = document.getElementById('dataDiriSection');

        if(nik.length !== 16) {
            statusText.innerHTML = '<span class="text-red-500 font-medium">NIK harus 16 digit!</span>';
            return;
        }

        statusText.innerHTML = '<span class="text-emerald-600 animate-pulse">Sedang mengecek data...</span>';
        
        try {
            const response = await axios.get('http://127.0.0.1:8000/api/warga/check?nik=' + nik);
            const warga = response.data.data;

            document.getElementById('namaWarga').value = warga.nama_lengkap;
            document.getElementById('nikWarga').value = warga.nik;
            document.getElementById('hiddenNik').value = warga.nik;
            
            section.style.display = 'block';
            statusText.innerHTML = '<span class="text-emerald-600 font-bold flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Data ditemukan!</span>';
            
        } catch (error) {
            section.style.display = 'none';
            if(error.response && error.response.status === 404) {
                statusText.innerHTML = '<span class="text-red-500 font-bold">Data tidak ditemukan! Hubungi Admin Desa.</span>';
            } else {
                 statusText.innerHTML = '<span class="text-red-500">Terjadi kesalahan koneksi.</span>';
            }
        }
    }
</script>

</div>
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
        animation: fadeInUp 0.5s ease-out forwards;
    }
</style>
@endsection

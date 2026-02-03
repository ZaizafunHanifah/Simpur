@extends('layouts.app')

@section('content')
<div class="pt-28 pb-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <a href="{{ route('admin.warga.index') }}" class="text-gray-500 hover:text-gray-900 font-medium transition-colors text-sm flex items-center mb-4">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Data Warga
        </a>
        <h2 class="text-3xl font-bold text-gray-900">Tambah Warga Baru</h2>
        <p class="text-gray-500">Pastikan data yang dimasukkan sesuai dengan KTP/KK.</p>
    </div>

    @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">
        <form action="{{ route('admin.warga.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- NIK -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Induk Kependudukan (NIK) <span class="text-red-500">*</span></label>
                    <input type="text" name="nik" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200 transition-all font-mono" placeholder="16 digit NIK" required maxlength="16">
                </div>

                <!-- No KK -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Kartu Keluarga (KK) <span class="text-red-500">*</span></label>
                    <input type="text" name="no_kk" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200 transition-all font-mono" placeholder="16 digit No. KK" required maxlength="16">
                </div>

                <!-- Nama Lengkap -->
                <div class="col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_lengkap" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200 transition-all" placeholder="Sesuai KTP" required>
                </div>

                <!-- RT & RW -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">RT / RW <span class="text-red-500">*</span></label>
                    <div class="flex gap-4">
                        <input type="text" name="rt" class="w-1/2 px-4 py-3 rounded-xl border border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200 transition-all" placeholder="RT" required maxlength="3">
                        <input type="text" name="rw" class="w-1/2 px-4 py-3 rounded-xl border border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200 transition-all" placeholder="RW" required maxlength="3">
                    </div>
                </div>

                <!-- Status Perkawinan -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Status Perkawinan</label>
                    <select name="status_perkawinan" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200 transition-all">
                        <option value="Belum Kawin">Belum Kawin</option>
                        <option value="Kawin">Kawin</option>
                        <option value="Cerai Hidup">Cerai Hidup</option>
                        <option value="Cerai Mati">Cerai Mati</option>
                    </select>
                </div>

                <!-- Tempat Lahir -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200 transition-all" placeholder="Kota/Kabupaten">
                </div>

                <!-- Tanggal Lahir -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200 transition-all">
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200 transition-all">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <!-- Agama -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Agama</label>
                    <select name="agama" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200 transition-all">
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Konghucu">Konghucu</option>
                    </select>
                </div>

                <!-- Pekerjaan -->
                <div class="col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Pekerjaan</label>
                    <input type="text" name="pekerjaan" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200 transition-all" placeholder="Pekerjaan saat ini">
                </div>

                <!-- Alamat -->
                <div class="col-span-2">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-emerald-500 focus:ring focus:ring-emerald-200 transition-all" placeholder="Nama Jalan, RT/RW, Dusun"></textarea>
                </div>
            </div>

            <div class="flex justify-end gap-4 border-t border-gray-100 pt-6 mt-6">
                <a href="{{ route('admin.warga.index') }}" class="px-6 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-8 py-3 bg-emerald-600 text-white rounded-xl font-bold hover:bg-emerald-700 shadow-lg shadow-emerald-200 transition-all transform hover:-translate-y-1">
                    Simpan Data Warga
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<!-- Hero Section Parallax -->
<div class="relative h-[500px] flex items-center justify-center overflow-hidden -mt-28">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('img/curug.jpg') }}" class="w-full h-full object-cover attachment-fixed" alt="Background">
        <div class="absolute inset-0 bg-gray-900/80"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent"></div>
    </div>
    
    <div class="relative z-10 text-center px-4 max-w-4xl mx-auto mt-20">
        <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-full border border-white/20 mb-6">
            <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
            <span class="text-emerald-100 text-xs font-bold tracking-widest uppercase">Profil Resmi Desa</span>
        </div>
        <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 tracking-tight leading-tight">
            Membangun Desa <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-300">Untuk Masa Depan</span>
        </h1>
        <p class="text-lg text-gray-300 max-w-2xl mx-auto font-light leading-relaxed">
            Struktur pemerintahan yang solid dan visi yang jelas untuk pelayanan masyarakat Desa Simpur yang lebih baik.
        </p>
    </div>
</div>

<!-- Stats Strip -->
<div class="relative z-20 -mt-16 max-w-6xl mx-auto px-4">
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x divide-gray-100">
        <div>
            <div class="text-3xl font-bold text-emerald-600">5.817</div>
            <div class="text-sm text-gray-500 font-medium uppercase tracking-wider mt-1">Penduduk</div>
        </div>
        <div>
            <div class="text-3xl font-bold text-blue-600">3</div>
            <div class="text-sm text-gray-500 font-medium uppercase tracking-wider mt-1">Dusun</div>
        </div>
        <div>
            <div class="text-3xl font-bold text-orange-600">Kec. Belik</div>
            <div class="text-sm text-gray-500 font-medium uppercase tracking-wider mt-1">Wilayah</div>
        </div>
        <div>
            <div class="text-3xl font-bold text-purple-600">Jawa Tengah</div>
            <div class="text-sm text-gray-500 font-medium uppercase tracking-wider mt-1">Provinsi</div>
        </div>
    </div>
</div>

<!-- Gambaran Umum Section -->
<div class="bg-white py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="space-y-6">
                <h2 class="text-sm font-bold text-emerald-600 uppercase tracking-widest">Gambaran Umum</h2>
                <h3 class="text-4xl font-bold text-gray-900">Desa di Lereng Gunung Slamet</h3>
                <p class="text-gray-600 text-lg leading-relaxed">
                    Desa Simpur adalah sebuah desa di Kecamatan Belik, Kabupaten Pemalang, Provinsi Jawa Tengah. Secara geografis berada di kawasan perbukitan dan dikelilingi oleh kesegaran aliran sungai seperti <strong>Sungai Paku, Sungai Comal, Sungai Wakung, Sungai Bela, dan Sungai Gandu</strong>.
                </p>
                <p class="text-gray-600 text-lg leading-relaxed">
                    Berdekatan dengan lereng di sebelah timur Gunung Slamet, Desa Simpur memiliki panorama alam pegunungan yang asri, menjadikannya sangat potensial untuk pengembangan kegiatan ekowisata alam.
                </p>
                
                <div class="grid grid-cols-2 gap-4 mt-8">
                    <div class="p-4 bg-emerald-50 rounded-xl">
                        <span class="block text-2xl font-bold text-emerald-700">2.956</span>
                        <span class="text-xs text-emerald-600 uppercase font-bold tracking-tight">Laki-laki</span>
                    </div>
                    <div class="p-4 bg-blue-50 rounded-xl">
                        <span class="block text-2xl font-bold text-blue-700">2.861</span>
                        <span class="text-xs text-blue-600 uppercase font-bold tracking-tight">Perempuan</span>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-4 pt-12">
                     <img src="{{ asset('img/curug.jpg') }}" class="rounded-2xl shadow-lg w-full h-64 object-cover" alt="Nature">
                     <div class="bg-slate-900 p-6 rounded-2xl text-white">
                         <h4 class="font-bold mb-2">Potensi Wisata</h4>
                         <p class="text-xs text-slate-400">Keindahan alam perbukitan dan aliran sungai yang jernih.</p>
                     </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-emerald-600 p-6 rounded-2xl text-white">
                         <h4 class="font-bold mb-2">Letak Geografis</h4>
                         <p class="text-xs text-emerald-100 italic">Eksotisme lereng timur Gunung Slamet.</p>
                     </div>
                     <img src="{{ asset('img/curug.jpg') }}" class="rounded-2xl shadow-lg w-full h-80 object-cover" alt="Village View">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Visi Misi & Sejarah -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
    <div class="grid lg:grid-cols-2 gap-16">
        <!-- Visi Misi -->
        <div class="space-y-8">
            <div>
                <h2 class="text-sm font-bold text-emerald-600 uppercase tracking-widest mb-2">Visi & Misi</h2>
                <h3 class="text-4xl font-bold text-gray-900 mb-4">Arah Pembangunan</h3>
                <p class="text-gray-500 text-lg leading-relaxed">
                    Komitmen kami untuk membangun pondasi masa depan desa yang lebih cerah melalui tata kelola yang tertib dan berwibawa.
                </p>
            </div>

            <div class="bg-emerald-50 rounded-2xl p-8 border-l-4 border-emerald-500">
                <h4 class="text-xl font-bold text-emerald-900 mb-2">Visi Utama</h4>
                <p class="text-emerald-700 italic font-medium text-lg">"Terwujudnya Desa Simpur yang Makmur dan Sejahtera."</p>
            </div>

            <div class="bg-blue-50 rounded-2xl p-8 border-l-4 border-blue-500">
                <h4 class="text-xl font-bold text-blue-900 mb-4">Misi Desa</h4>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <span class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3 mt-1 flex-shrink-0">1</span>
                        <p class="text-blue-800 font-medium">Mewujudkan Pemerintahan Desa yang Tertib dan Berwibawa.</p>
                    </li>
                    <li class="flex items-start">
                        <span class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3 mt-1 flex-shrink-0">2</span>
                        <p class="text-blue-800 font-medium">Mewujudkan Keamanan dan Kesejahteraan Warga Desa.</p>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Sejarah -->
        <div class="space-y-8">
            <div>
                <h2 class="text-sm font-bold text-purple-600 uppercase tracking-widest mb-2">Catatan Historis</h2>
                <h3 class="text-4xl font-bold text-gray-900 mb-4">Sejarah Desa</h3>
                <div class="prose prose-slate text-gray-500 text-lg leading-relaxed">
                    <p>
                        Sejauh ini belum tersedia catatan sejarah resmi terperinci mengenai tanggal atau tahun pasti pembentukan Desa Simpur sebagai desa administrasi. Informasi tersebut umumnya tercatat dalam arsip pemerintah kabupaten atau Monografi Desa yang bersifat internal.
                    </p>
                    <p class="mt-4">
                        Masyarakat dapat menghubungi Kantor Desa Simpur untuk mendapatkan data historis administratif yang lebih rinci mengenai asal-usul pedusunan dan perkembangan desa dari masa ke masa.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Organizational Chart Section -->
<div class="bg-slate-900 py-24 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-5"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-20">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Struktur Pemerintah Desa</h2>
            <div class="w-24 h-1 bg-emerald-500 mx-auto rounded-full"></div>
        </div>

        <div class="flex flex-col items-center space-y-12">
            <!-- Level 1: Kades & BPD -->
            <div class="flex flex-col md:flex-row gap-12 md:gap-32 items-center">
                <!-- Kepala Desa -->
                <div class="relative group">
                    <div class="w-64 bg-white rounded-3xl p-2 shadow-2xl transform hover:scale-105 transition-all duration-300">
                        <div class="bg-slate-100 rounded-t-3xl h-24 overflow-hidden relative">
                            <div class="absolute inset-0 bg-emerald-600 opacity-10"></div>
                            <img src="https://ui-avatars.com/api/?name=Poniman&background=047857&color=fff&size=128" class="w-20 h-20 rounded-full border-4 border-white absolute -bottom-10 left-1/2 transform -translate-x-1/2 shadow-lg">
                        </div>
                        <div class="pt-12 pb-4 text-center px-4">
                            <h3 class="text-lg font-bold text-gray-900 uppercase">Poniman</h3>
                            <p class="text-emerald-600 text-xs font-bold uppercase tracking-wider mt-1">Kepala Desa</p>
                        </div>
                    </div>
                </div>

                <!-- BPD -->
                <div class="relative group">
                    <div class="w-64 bg-slate-800 rounded-3xl p-6 border border-slate-700 text-center shadow-xl">
                        <div class="w-16 h-16 mx-auto bg-slate-700 rounded-full mb-3 flex items-center justify-center text-xl text-white font-bold">BPD</div>
                        <h3 class="text-lg font-bold text-white uppercase">-</h3>
                        <p class="text-slate-400 text-xs font-bold uppercase tracking-wider mt-1">Badan Permusyawaratan Desa</p>
                    </div>
                </div>
            </div>

            <!-- Level 2: Sekdes -->
            <div class="relative">
                <div class="w-64 bg-white/95 backdrop-blur rounded-2xl p-4 shadow-xl border border-white/10 text-center mx-auto">
                    <img src="https://ui-avatars.com/api/?name=Puji&background=0D9488&color=fff&size=128" class="w-16 h-16 rounded-full mx-auto mb-3 border-2 border-white shadow">
                    <h4 class="font-bold text-gray-900 uppercase">Puji</h4>
                    <p class="text-xs text-slate-500 font-bold uppercase">Sekretaris Desa</p>
                </div>
            </div>

            <!-- Level 3: Kaur -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-5xl px-4">
                @php
                    $kaurs = [
                        'Kaur Tata Usaha' => '-',
                        'Kaur Keuangan' => 'Tarjono',
                        'Kaur Perencanaan' => 'Keni Damayanti'
                    ];
                @endphp
                @foreach($kaurs as $jabatan => $nama)
                <div class="bg-slate-800 rounded-2xl p-4 border border-slate-700 text-center hover:bg-slate-750 transition-colors group">
                    <div class="w-12 h-12 mx-auto bg-slate-700 rounded-full mb-3 flex items-center justify-center text-lg group-hover:bg-blue-600 transition-colors text-white">
                        {{ substr($nama, 0, 1) }}
                    </div>
                    <h5 class="text-white font-bold text-sm uppercase">{{ $nama }}</h5>
                    <p class="text-slate-400 text-[10px] uppercase tracking-wider mt-1">{{ $jabatan }}</p>
                </div>
                @endforeach
            </div>

            <!-- Level 4: Kasi -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-5xl px-4">
                @php
                    $kasis = [
                        'Kasi Pemerintahan' => 'Abdul Rohman',
                        'Kasi Kesejahteraan' => 'Nurdianto',
                        'Kasi Pelayanan' => 'Darori'
                    ];
                @endphp
                @foreach($kasis as $jabatan => $nama)
                <div class="bg-slate-800 rounded-2xl p-4 border border-slate-700 text-center hover:bg-slate-750 transition-colors group">
                    <div class="w-12 h-12 mx-auto bg-slate-700 rounded-full mb-3 flex items-center justify-center text-lg group-hover:bg-emerald-600 transition-colors text-white">
                        {{ substr($nama, 0, 1) }}
                    </div>
                    <h5 class="text-white font-bold text-sm uppercase">{{ $nama }}</h5>
                    <p class="text-slate-400 text-[10px] uppercase tracking-wider mt-1">{{ $jabatan }}</p>
                </div>
                @endforeach
            </div>

            <!-- Level 5: Kadus -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-5xl px-4">
                @php
                    $kadus = [
                        'Kadus Cengis' => '-',
                        'Kadus Mrica' => 'Lili Suharsih',
                        'Kadus Barong' => 'Arif Maulana'
                    ];
                @endphp
                @foreach($kadus as $jabatan => $nama)
                <div class="bg-slate-800 rounded-2xl p-4 border border-slate-700 text-center hover:bg-slate-750 transition-colors group">
                    <div class="w-12 h-12 mx-auto bg-slate-700 rounded-full mb-3 flex items-center justify-center text-lg group-hover:bg-purple-600 transition-colors text-white">
                        {{ substr($nama, 0, 1) }}
                    </div>
                    <h5 class="text-white font-bold text-sm uppercase">{{ $nama }}</h5>
                    <p class="text-slate-400 text-[10px] uppercase tracking-wider mt-1">{{ $jabatan }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

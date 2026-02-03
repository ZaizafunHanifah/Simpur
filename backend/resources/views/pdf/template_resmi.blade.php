<!DOCTYPE html>
<html>
<head>
    <title>Surat Resmi Desa Simpur</title>
    <style>
        body { font-family: 'Times New Roman', serif; line-height: 1.5; }
        .kop-surat { text-align: center; border-bottom: 3px double black; padding-bottom: 10px; margin-bottom: 20px; }
        .kop-surat img { width: 80px; position: absolute; left: 0; top: 0; }
        .kop-surat h2 { margin: 0; font-size: 18px; text-transform: uppercase; }
        .kop-surat h3 { margin: 0; font-size: 14px; font-weight: normal; }
        .kop-surat p { margin: 0; font-size: 12px; font-style: italic; }
        
        .nomor-surat { text-align: center; margin-bottom: 30px; }
        .nomor-surat h4 { margin: 0; text-decoration: underline; }
        
        .isi-surat { text-align: justify; margin-bottom: 50px; }
        
        .ttd { float: right; text-align: center; width: 200px; }
        .ttd-date { margin-bottom: 80px; }
    </style>
</head>
<body>
    <div class="kop-surat">
        <img src="{{ public_path('assets/logo-pemalang.png') }}" alt="Logo">
        <h2>PEMERINTAH KABUPATEN PEMALANG</h2>
        <h2>KECAMATAN BELIK</h2>
        <h2>DESA SIMPUR</h2>
        <p>Alamat: Jl. Raya Simpur No. 1, Kecamatan Belik, Kabupaten Pemalang, Jawa Tengah 52356</p>
    </div>

    <div class="nomor-surat">
        <h4>{{ strtoupper($surat->templateSurat->nama_template) }}</h4>
        <p>Nomor: {{ $nomor }}</p>
    </div>

    <div class="isi-surat">
        <p>Yang bertanda tangan di bawah ini {{ $surat->penandatangan_jabatan ?? 'Kepala Desa' }} Simpur, Kecamatan Belik, Kabupaten Pemalang, menerangkan bahwa:</p>
        
        <table>
            <tr><td width="150">Nama</td><td>: {{ $warga->nama_lengkap }}</td></tr>
            <tr><td>NIK</td><td>: {{ $warga->nik }}</td></tr>
            <tr><td>Tempat/Tgl Lahir</td><td>: {{ $warga->tempat_lahir }}, {{ \Carbon\Carbon::parse($warga->tanggal_lahir)->translatedFormat('d F Y') }}</td></tr>
            <tr><td>Alamat</td><td>: {{ $warga->alamat }}</td></tr>
        </table>

        <br>
        
        <!-- Konten Dinamis Area -->
        <div style="margin-bottom: 20px;">
            {!! $konten !!}
        </div>

        <p>Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.</p>
    </div>

    <div class="ttd">
        <div class="ttd-date">
            Simpur, {{ $surat->signed_at ? \Carbon\Carbon::parse($surat->signed_at)->translatedFormat('d F Y') : \Carbon\Carbon::now()->translatedFormat('d F Y') }} <br>
            {{ $surat->penandatangan_jabatan ?? 'Kepala Desa Simpur' }}
        </div>
        
        <div style="margin-top: 60px;">
            <b>{{ $surat->penandatangan_nama ?? '(..........................)' }}</b>
        </div>
    </div>
</body>
</html>

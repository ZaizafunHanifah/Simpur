<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TemplateSurat;

class TemplateSuratSeeder extends Seeder
{
    public function run(): void
    {
        TemplateSurat::create([
            'nama_template' => 'Surat Keterangan Usaha',
            'kode_surat' => '503',
            'konten_template' => '<p>Menerangkan dengan sebenarnya bahwa:</p>
            <p><strong>{{nama}}</strong> adalah benar-benar warga Desa Simpur yang mempunyai usaha:</p>
            <p><strong>{{nama_usaha}}</strong></p>
            <p>yang berlokasi di {{alamat}}.</p>
            <p>Surat keterangan ini dibuat untuk keperluan: {{keperluan}}</p>',
            'is_active' => true,
        ]);

        TemplateSurat::create([
            'nama_template' => 'Surat Keterangan Domisili',
            'kode_surat' => '470',
            'konten_template' => '<p>Menerangkan bahwa:</p>
            <p>Nama: <strong>{{nama}}</strong></p>
            <p>NIK: {{nik}}</p>
            <p>Adalah benar-benar penduduk yang berdomisili di Desa Simpur, Kecamatan Belik, Kabupaten Pemalang.</p>
            <p>Surat ini dibuat untuk keperluan: {{keperluan}}</p>',
            'is_active' => true,
        ]);
    }
}

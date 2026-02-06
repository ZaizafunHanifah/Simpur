<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $beritas = [
            [
                'judul' => 'Camat Belik Tinjau Proyek Jalan di Dusun Krikil, Desa Simpur',
                'link' => 'https://belik.pemalangkab.go.id/2025/09/camat-belik-tinjau-proyek-jalan-di-dusun-krikil-desa-simpur/',
                'sumber' => 'Pemkab Pemalang',
                'gambar' => 'https://belik.pemalangkab.go.id/wp-content/uploads/2023/10/Placeholder-Image.jpg',
                'deskripsi' => 'Camat Belik mendatangi lokasi pembangunan jalan di Dusun Krikil untuk memastikan kualitas proyek.'
            ],
            [
                'judul' => 'Sosialisasi Pencegahan dan Penanggulangan Kebakaran di Desa Simpur, Kecamatan Belik',
                'link' => 'https://belik.pemalangkab.go.id/2025/07/sosialisasi-pencegahan-dan-penaggulangan-kebakaran-di-desa-simpur-kecamatan-belik/',
                'sumber' => 'Pemkab Pemalang',
                'gambar' => 'https://belik.pemalangkab.go.id/wp-content/uploads/2023/10/Placeholder-Image.jpg',
                'deskripsi' => 'Kegiatan preventif untuk meningkatkan kewaspadaan warga terhadap bahaya kebakaran.'
            ],
            [
                'judul' => 'Camat Belik Tinjau Jalan Rusak di Dukuh Krikil, Desa Simpur',
                'link' => 'https://belik.pemalangkab.go.id/2025/09/camat-belik-tinjau-jalan-rusak-di-dukuh-krikil-desa-simpur-kec-belik-kab-pemalang/',
                'sumber' => 'Pemkab Pemalang',
                'gambar' => 'https://belik.pemalangkab.go.id/wp-content/uploads/2023/10/Placeholder-Image.jpg',
                'deskripsi' => 'Monitoring kondisi infrastruktur jalan yang membutuhkan perbaikan mendesak.'
            ],
            [
                'judul' => 'Camat Belik Monitoring Paska Rehab Jalan di Desa Simpur, Pemalang',
                'link' => 'https://belik.pemalangkab.go.id/2025/09/camat-belik-monitoring-paska-rehab-jalan-di-desa-simpur-pemalang/',
                'sumber' => 'Pemkab Pemalang',
                'gambar' => 'https://belik.pemalangkab.go.id/wp-content/uploads/2023/10/Placeholder-Image.jpg',
                'deskripsi' => 'Peninjauan hasil rehabilitasi jalan untuk kenyamanan transportasi warga.'
            ],
            [
                'judul' => 'Desa Simpur Diserbu 900 Rider! Wisata Trabas Pemalang Kian Dikenal Lewat Baksos TNI',
                'link' => 'https://www.g-news.id/pemalang/1581689285/desa-simpur-diserbu-900-rider-wisata-trabas-pemalang-kian-dikenal-lewat-baksos-tni',
                'sumber' => 'G-News',
                'gambar' => 'https://images.unsplash.com/photo-1558981403-c5f91cb9c2f1?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'deskripsi' => 'Event Trabas akbar yang memperkenalkan potensi wisata alam Desa Simpur.'
            ],
            [
                'judul' => 'Berharap Perhatian Bupati Pemalang, Warga Simpur Gotong Royong Perbaiki Jalan Rusak Bertahun-tahun',
                'link' => 'https://pemalang.inews.id/read/624378/berharap-perhatian-bupati-pemalang-warga-simpur-gotong-royong-perbaiki-jalan-rusak-bertahun-tahun',
                'sumber' => 'iNews Pemalang',
                'gambar' => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'deskripsi' => 'Inisiatif warga memperbaiki jalan secara swadaya sebagai bentuk kepedulian bersama.'
            ],
            [
                'judul' => 'Warga Simpur Kabupaten Pemalang Ramai-ramai Perbaiki Jalan',
                'link' => 'https://jateng.disway.id/disway-pekalongan/read/712528/warga-simpur-kabupaten-pemalang-ramai-ramai-perbaiki-jalan',
                'sumber' => 'Disway Jateng',
                'gambar' => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'deskripsi' => 'Kompaknya warga Desa Simpur dalam memperbaiki akses jalan desa.'
            ],
            [
                'judul' => 'Pelaksanaan Barong Bersholawat di Warnai Pemberian Bantuan Korban Longsor Desa Simpur',
                'link' => 'https://www.g-news.id/pemalang/158738618/pelaksanaan-barong-bersholawat-di-warnai-pemberian-bantuan-korban-longsor-desa-simpur',
                'sumber' => 'G-News',
                'gambar' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'deskripsi' => 'Kegiatan religius yang dirangkai dengan aksi kemanusiaan bagi warga terdampak longsor.'
            ],
            [
                'judul' => 'Koperasi Desa Simpur Mulai Dibangun, Diharapkan Jadi Penggerak Ekonomi Warga',
                'link' => 'https://www.g-news.id/pemalang/1582087231/koperasi-desa-simpur-mulai-dibangun-diharapkan-jadi-penggerak-ekonomi-warga',
                'sumber' => 'G-News',
                'gambar' => 'https://images.unsplash.com/photo-1521791136064-7986c2959213?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'deskripsi' => 'Pembangunan sarana ekonomi untuk kesejahteraan masyarakat desa.'
            ],
            [
                'judul' => 'Program PPTPKH: Tiga Lokasi TPU di Desa Simpur dalam Kawasan Hutan Perhutani akan Resmi Milik Desa',
                'link' => 'https://pemalang.inews.id/read/520924/program-pptpkh-tiga-lokasi-tpu-di-desa-simpur-dalam-kawasan-hutan-perhutani-akan-resmi-milik-desa',
                'sumber' => 'iNews Pemalang',
                'gambar' => 'https://images.unsplash.com/photo-1621570074291-7661b608820c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'deskripsi' => 'Peralihan status lahan TPU menjadi aset resmi desa melalui program strategis.'
            ],
            [
                'judul' => 'Desa Simpur Mengucapkan Selamat Hari Jadi Kabupaten Pemalang ke-450, Membangun Bersama Menuju Pemalang “Emas”',
                'link' => 'https://revolusinews.com/desa-simpur-mengucapkan-selamat-hari-jadi-kabupaten-pemalang-ke-450-membangun-bersama-menuju-pemalang-emas/',
                'sumber' => 'Revolusi News',
                'gambar' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80',
                'deskripsi' => 'Ucapan selamat dan doa untuk kemajuan Kabupaten Pemalang dari warga Simpur.'
            ],
        ];

        foreach ($beritas as $berita) {
            \App\Models\Berita::updateOrCreate(
                ['judul' => $berita['judul']],
                [
                    'link' => $berita['link'],
                    'sumber' => $berita['sumber'],
                    'gambar' => $berita['gambar'],
                    'deskripsi' => $berita['deskripsi']
                ]
            );
        }
    }
}

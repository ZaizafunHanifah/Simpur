-- Simpur System Dummy Data SQL
-- Generated for Manual Import

SET FOREIGN_KEY_CHECKS = 0;

-- 1. Truncate Tables
TRUNCATE TABLE users;
TRUNCATE TABLE warga;
TRUNCATE TABLE template_surat;
TRUNCATE TABLE beritas;

SET FOREIGN_KEY_CHECKS = 1;

-- 2. Insert Users (Password: 'password')
INSERT INTO users (id, name, email, password, created_at, updated_at) VALUES
(1, 'Budi Santoso', 'warga@simpur.desa.id', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NOW(), NOW()),
(2, 'Admin Desa', 'admin@simpur.desa.id', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NOW(), NOW());

-- 3. Insert Warga Profile
INSERT INTO warga (id, user_id, nik, no_kk, nama_lengkap, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, rt, rw, desa, kecamatan, kabupaten, pekerjaan, status_perkawinan, created_at, updated_at) VALUES
(1, 1, '3327091234560001', '3327096543210001', 'Budi Santoso', 'Pemalang', '1990-05-12', 'L', 'Dusun Krajan', '01', '02', 'Simpur', 'Belik', 'Pemalang', 'Wirausaha', 'Kawin', NOW(), NOW());

-- 4. Insert Template Surat
INSERT INTO template_surat (id, nama_template, kode_surat, konten_template, is_active, created_at, updated_at) VALUES
(1, 'Surat Keterangan Usaha', '503', '<p>Menerangkan dengan sebenarnya bahwa:</p><p><strong>{{nama}}</strong> adalah benar-benar warga Desa Simpur yang mempunyai usaha:</p><p><strong>{{nama_usaha}}</strong></p><p>yang berlokasi di {{alamat}}.</p><p>Surat keterangan ini dibuat untuk keperluan: {{keperluan}}</p>', 1, NOW(), NOW()),
(2, 'Surat Keterangan Domisili', '470', '<p>Menerangkan bahwa:</p><p>Nama: <strong>{{nama}}</strong></p><p>NIK: {{nik}}</p><p>Adalah benar-benar penduduk yang berdomisili di Desa Simpur, Kecamatan Belik, Kabupaten Pemalang.</p><p>Surat ini dibuat untuk keperluan: {{keperluan}}</p>', 1, NOW(), NOW());

-- 5. Insert Berita
INSERT INTO beritas (judul, link, sumber, gambar, deskripsi, created_at, updated_at) VALUES
('Camat Belik Tinjau Proyek Jalan di Dusun Krikil, Desa Simpur', 'https://belik.pemalangkab.go.id/2025/09/camat-belik-tinjau-proyek-jalan-di-dusun-krikil-desa-simpur/', 'Pemkab Pemalang', 'https://belik.pemalangkab.go.id/wp-content/uploads/2023/10/Placeholder-Image.jpg', 'Camat Belik mendatangi lokasi pembangunan jalan di Dusun Krikil untuk memastikan kualitas proyek.', NOW(), NOW()),
('Sosialisasi Pencegahan dan Penanggulangan Kebakaran di Desa Simpur, Kecamatan Belik', 'https://belik.pemalangkab.go.id/2025/07/sosialisasi-pencegahan-dan-penaggulangan-kebakaran-di-desa-simpur-kecamatan-belik/', 'Pemkab Pemalang', 'https://belik.pemalangkab.go.id/wp-content/uploads/2023/10/Placeholder-Image.jpg', 'Kegiatan preventif untuk meningkatkan kewaspadaan warga terhadap bahaya kebakaran.', NOW(), NOW()),
('Camat Belik Tinjau Jalan Rusak di Dukuh Krikil, Desa Simpur', 'https://belik.pemalangkab.go.id/2025/09/camat-belik-tinjau-jalan-rusak-di-dukuh-krikil-desa-simpur-kec-belik-kab-pemalang/', 'Pemkab Pemalang', 'https://belik.pemalangkab.go.id/wp-content/uploads/2023/10/Placeholder-Image.jpg', 'Monitoring kondisi infrastruktur jalan yang membutuhkan perbaikan mendesak.', NOW(), NOW()),
('Camat Belik Monitoring Paska Rehab Jalan di Desa Simpur, Pemalang', 'https://belik.pemalangkab.go.id/2025/09/camat-belik-monitoring-paska-rehab-jalan-di-desa-simpur-pemalang/', 'Pemkab Pemalang', 'https://belik.pemalangkab.go.id/wp-content/uploads/2023/10/Placeholder-Image.jpg', 'Peninjauan hasil rehabilitasi jalan untuk kenyamanan transportasi warga.', NOW(), NOW()),
('Desa Simpur Diserbu 900 Rider! Wisata Trabas Pemalang Kian Dikenal Lewat Baksos TNI', 'https://www.g-news.id/pemalang/1581689285/desa-simpur-diserbu-900-rider-wisata-trabas-pemalang-kian-dikenal-lewat-baksos-tni', 'G-News', 'https://images.unsplash.com/photo-1558981403-c5f91cb9c2f1?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80', 'Event Trabas akbar yang memperkenalkan potensi wisata alam Desa Simpur.', NOW(), NOW()),
('Berharap Perhatian Bupati Pemalang, Warga Simpur Gotong Royong Perbaiki Jalan Rusak Bertahun-tahun', 'https://pemalang.inews.id/read/624378/berharap-perhatian-bupati-pemalang-warga-simpur-gotong-royong-perbaiki-jalan-rusak-bertahun-tahun', 'iNews Pemalang', 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80', 'Inisiatif warga memperbaiki jalan secara swadaya sebagai bentuk kepedulian bersama.', NOW(), NOW()),
('Warga Simpur Kabupaten Pemalang Ramai-ramai Perbaiki Jalan', 'https://jateng.disway.id/disway-pekalongan/read/712528/warga-simpur-kabupaten-pemalang-ramai-ramai-perbaiki-jalan', 'Disway Jateng', 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80', 'Kompaknya warga Desa Simpur dalam memperbaiki akses jalan desa.', NOW(), NOW()),
('Pelaksanaan Barong Bersholawat di Warnai Pemberian Bantuan Korban Longsor Desa Simpur', 'https://www.g-news.id/pemalang/158738618/pelaksanaan-barong-bersholawat-di-warnai-pemberian-bantuan-korban-longsor-desa-simpur', 'G-News', 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80', 'Kegiatan religius yang dirangkai dengan aksi kemanusiaan bagi warga terdampak longsor.', NOW(), NOW()),
('Koperasi Desa Simpur Mulai Dibangun, Diharapkan Jadi Penggerak Ekonomi Warga', 'https://www.g-news.id/pemalang/1582087231/koperasi-desa-simpur-mulai-dibangun-diharapkan-jadi-penggerak-ekonomi-warga', 'G-News', 'https://images.unsplash.com/photo-1521791136064-7986c2959213?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80', 'Pembangunan sarana ekonomi untuk kesejahteraan masyarakat desa.', NOW(), NOW()),
('Program PPTPKH: Tiga Lokasi TPU di Desa Simpur dalam Kawasan Hutan Perhutani akan Resmi Milik Desa', 'https://pemalang.inews.id/read/520924/program-pptpkh-tiga-lokasi-tpu-di-desa-simpur-dalam-kawasan-hutan-perhutani-akan-resmi-milik-desa', 'iNews Pemalang', 'https://images.unsplash.com/photo-1621570074291-7661b608820c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80', 'Peralihan status lahan TPU menjadi aset resmi desa melalui program strategis.', NOW(), NOW()),
('Desa Simpur Mengucapkan Selamat Hari Jadi Kabupaten Pemalang ke-450, Membangun Bersama Menuju Pemalang “Emas”', 'https://revolusinews.com/desa-simpur-mengucapkan-selamat-hari-jadi-kabupaten-pemalang-ke-450-membangun-bersama-menuju-pemalang-emas/', 'Revolusi News', 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80', 'Ucapan selamat dan doa untuk kemajuan Kabupaten Pemalang dari warga Simpur.', NOW(), NOW());

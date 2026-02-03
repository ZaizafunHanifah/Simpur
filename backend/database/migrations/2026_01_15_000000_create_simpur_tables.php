<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Setup Roles & Permissions (usually handled by Spatie package migration, but simplified here for demo)
        // users table already exists in standard Laravel
        
        // 2. Data Warga (Citizen Data)
        Schema::create('warga', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Link to auth user
            $table->string('nik', 16)->unique();
            $table->string('no_kk', 16);
            $table->string('nama_lengkap');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat');
            $table->string('rt', 3);
            $table->string('rw', 3);
            $table->string('desa')->default('Simpur');
            $table->string('kecamatan')->default('Belik');
            $table->string('kabupaten')->default('Pemalang');
            $table->string('pekerjaan');
            $table->string('status_perkawinan');
            $table->timestamps();
        });

        // 3. Template Surat
        Schema::create('template_surat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_template'); // MISAL: 'Surat Keterangan Usaha'
            $table->string('kode_surat'); // MISAL: '470' (Kode Klasifikasi)
            $table->text('konten_template'); // HTML content with placeholders {{nama}}
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 4. Nomor Surat (Counter)
        Schema::create('nomor_surat', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun');
            $table->integer('bulan');
            $table->integer('urutan'); // Last sed number
            $table->string('kode_surat'); // Optional partition by code
            $table->unique(['tahun', 'kode_surat']); // Reset per tahun per kode
            $table->timestamps();
        });

        // 5. Pengajuan Surat (Submission) & Surat Final
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique(); // For public verification
            $table->foreignId('warga_id')->constrained('warga');
            $table->foreignId('template_surat_id')->constrained('template_surat');
            
            // Nomor Surat Fields
            $table->string('nomor_surat_final')->nullable(); // "001/DS-SIMPUR/II/2026"
            $table->integer('urutan_surat')->nullable();
            
            // Status Flow
            $table->enum('status', ['diajukan', 'diverifikasi', 'diproses', 'menunggu_ttd', 'selesai', 'ditolak'])->default('diajukan');
            
            // Data Dinamis (JSON) for placeholders
            $table->json('data_input')->nullable(); // {"keperluan": "Pinjaman Bank", "nama_usaha": "Warung Makan"}
            
            // Log Access
            $table->foreignId('verified_by')->nullable()->constrained('users');
            $table->foreignId('signed_by')->nullable()->constrained('users');
            $table->timestamp('signed_at')->nullable();
            
            $table->string('file_path')->nullable(); // Path to PDF
            $table->timestamps();
        });

        // 6. DB View Simplification
        DB::statement("
            CREATE VIEW view_pengajuan_lengkap AS
            SELECT 
                s.id,
                s.uuid,
                s.nomor_surat_final,
                s.status,
                s.created_at as tanggal_pengajuan,
                w.nik,
                w.nama_lengkap,
                t.nama_template
            FROM surat s
            JOIN warga w ON s.warga_id = w.id
            JOIN template_surat t ON s.template_surat_id = t.id
        ");
    }

    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS view_pengajuan_lengkap");
        Schema::dropIfExists('surat');
        Schema::dropIfExists('nomor_surat');
        Schema::dropIfExists('template_surat');
        Schema::dropIfExists('warga');
    }
};

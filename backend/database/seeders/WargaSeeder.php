<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class WargaSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create User for Warga
        $user = User::create([
            'name' => 'Budi Santoso',
            'email' => 'warga@simpur.desa.id',
            'password' => Hash::make('password'),
        ]);

        // 2. Create Warga Profile
        Warga::create([
            'user_id' => $user->id,
            'nik' => '3327091234560001',
            'no_kk' => '3327096543210001',
            'nama_lengkap' => 'Budi Santoso',
            'tempat_lahir' => 'Pemalang',
            'tanggal_lahir' => Carbon::parse('1990-05-12'),
            'jenis_kelamin' => 'L',
            'alamat' => 'Dusun Krajan',
            'rt' => '01',
            'rw' => '02',
            'desa' => 'Simpur',
            'kecamatan' => 'Belik',
            'kabupaten' => 'Pemalang',
            'pekerjaan' => 'Wirausaha',
            'status_perkawinan' => 'Kawin',
        ]);
        
        // 3. Create Admin User (Optional if needed explicitly)
        User::create([
            'name' => 'Admin Desa',
            'email' => 'admin@simpur.desa.id',
            'password' => Hash::make('password'),
            // Role assignment would happen here if using Spatie
        ]);
    }
}

<?php
require __DIR__.'/vendor/autoload.php';
$app = require __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "Creating User...\n";
    $u = \App\Models\User::firstOrCreate(
        ['email'=>'warga@simpur.desa.id'], 
        ['name'=>'Budi Santoso', 'password'=>password_hash('password', PASSWORD_BCRYPT)]
    );
    echo "User Created: " . $u->id . "\n";

    echo "Creating Warga...\n";
    $w = \App\Models\Warga::firstOrCreate(
        ['nik'=>'3327091234560001'], 
        [
            'user_id'=>$u->id, 
            'no_kk'=>'3327096543210001', 
            'nama_lengkap'=>'Budi Santoso', 
            'tempat_lahir'=>'Pemalang', 
            'tanggal_lahir'=>'1990-05-12', 
            'jenis_kelamin'=>'L', 
            'alamat'=>'Dusun Krajan', 
            'rt'=>'01', 
            'rw'=>'02', 
            'desa'=>'Simpur', 
            'kecamatan'=>'Belik', 
            'kabupaten'=>'Pemalang', 
            'pekerjaan'=>'Wirausaha', 
            'status_perkawinan'=>'Kawin'
        ]
    );
    echo "Warga Created: " . $w->id . "\n";
    
    // Create Templates
    \App\Models\TemplateSurat::firstOrCreate(['kode_surat'=>'503'], [
        'nama_template' => 'Surat Keterangan Usaha',
        'konten_template' => '<p>Yang bertanda tangan di bawah ini...</p>',
        'is_active' => true
    ]);
    
    echo "Templates Created.\n";

    echo "Creating Admin...\n";
    $admin = \App\Models\User::firstOrCreate(
        ['email'=>'admin@simpur.desa.id'], 
        ['name'=>'Admin Desa', 'password'=>password_hash('password', PASSWORD_BCRYPT)]
    );
    echo "Admin Created: " . $admin->id . "\n";

} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString();
}

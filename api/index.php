<?php
// 1. Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');

// 2. Setup folder writable di Vercel (/tmp)
$storagePath = '/tmp/storage';
foreach (['/framework/views', '/framework/cache', '/framework/sessions', '/logs'] as $path) {
    if (!is_dir($storagePath . $path)) {
        mkdir($storagePath . $path, 0755, true);
    }
}

// 3. Muat Autoloader
require __DIR__ . '/../vendor/autoload.php';

// 4. Inisialisasi Aplikasi
// Kita panggil bootstrap dari folder frontend
$app = require_once __DIR__ . '/../frontend/bootstrap/app.php';

// 5. Override Paths penting agar Laravel tidak tersesat
$app->useStoragePath($storagePath);
$app->bind('path.public', function() {
    return __DIR__ . '/../frontend/public';
});

// 6. Jalankan Request
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
)->send();

$kernel->terminate($request, $response);

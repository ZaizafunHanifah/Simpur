<?php
// 1. Matikan error display jika sudah tidak dibutuhkan, tapi biarkan E_ALL saat debug
error_reporting(E_ALL);
ini_set('display_errors', '1');

// 2. Setup folder writable di Vercel (/tmp)
$storagePath = '/tmp/storage';
foreach (['/framework/views', '/framework/cache', '/framework/sessions', '/logs'] as $path) {
    if (!is_dir($storagePath . $path)) {
        mkdir($storagePath . $path, 0755, true);
    }
}

// 3. Muat Autoloader dari Root
require __DIR__ . '/../vendor/autoload.php';

// 4. Inisialisasi Aplikasi Laravel dengan Path Manual
// Kita beri tahu Laravel bahwa base path-nya adalah di folder 'frontend'
$app = require_once __DIR__ . '/../frontend/bootstrap/app.php';

// 5. Override Path secara Paksa agar Laravel tahu mana folder aslinya
$app->useStoragePath($storagePath);
$app->instance('path.config', realpath(__DIR__ . '/../frontend/config'));
$app->instance('path.public', realpath(__DIR__ . '/../frontend/public'));
$app->instance('path.resources', realpath(__DIR__ . '/../frontend/resources'));

// 6. Jalankan Request
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
)->send();

$kernel->terminate($request, $response);

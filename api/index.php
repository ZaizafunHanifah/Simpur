<?php
// 1. Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');

// 2. Definisi Path
$basePath = realpath(__DIR__ . '/../frontend');
$storagePath = '/tmp/storage';

// 3. Setup Folder Writable
foreach (['/framework/views', '/framework/cache', '/framework/sessions', '/logs'] as $path) {
    if (!is_dir($storagePath . $path)) {
        mkdir($storagePath . $path, 0755, true);
    }
}

// 4. Set Envs Penting
$_ENV['APP_BASE_PATH'] = $basePath;
putenv("APP_BASE_PATH=$basePath");
putenv("VIEW_COMPILED_PATH=$storagePath/framework/views");

// 5. Muat Autoloader dari Root
require __DIR__ . '/../vendor/autoload.php';

// 6. Inisialisasi App
$app = require_once $basePath . '/bootstrap/app.php';

// 7. Override Storage Path
$app->useStoragePath($storagePath);

// 8. Jalankan Kernel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
)->send();

$kernel->terminate($request, $response);

<?php
// Paksa tampilkan eror di paling awal
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Setup folder writable di Vercel (/tmp)
$folders = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs'
];
foreach ($folders as $folder) {
    if (!is_dir($folder)) {
        mkdir($folder, 0755, true);
    }
}

// Override folder storage Laravel agar ke /tmp
putenv('APP_DEBUG=true');
putenv('APP_ENV=production');
putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');
putenv('SESSION_DRIVER=cookie');
putenv('CACHE_STORE=array');
putenv('LOG_CHANNEL=stderr');

// Jalankan Laravel
require __DIR__ . '/../frontend/public/index.php';

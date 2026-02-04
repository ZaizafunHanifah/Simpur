<?php
// Menampilkan eror secara paksa untuk debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Laravel butuh folder yang bisa ditulis. Di Vercel hanya folder /tmp yang bisa.
if (!is_dir('/tmp/storage/framework/views')) {
    mkdir('/tmp/storage/framework/views', 0755, true);
    mkdir('/tmp/storage/framework/cache', 0755, true);
    mkdir('/tmp/storage/framework/sessions', 0755, true);
}

// Set Environment Variables secara programmatically untuk Vercel
putenv('VIEW_COMPILED_PATH=/tmp/storage/framework/views');
putenv('SESSION_DRIVER=cookie');
putenv('LOG_CHANNEL=stderr');

// Vercel entry point
require __DIR__ . '/../frontend/public/index.php';

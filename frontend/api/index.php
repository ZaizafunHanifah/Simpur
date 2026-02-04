<?php
/**
 * Standard Vercel Bridge for Laravel 11/12
 */

// 1. Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');

try {
    // 2. Writable Storage for Vercel (/tmp)
    $storagePath = '/tmp/storage';
    foreach (['/framework/views', '/framework/cache', '/framework/sessions', '/logs'] as $path) {
        if (!is_dir($storagePath . $path)) {
            @mkdir($storagePath . $path, 0755, true);
        }
    }

    // 3. Autoloader
    require __DIR__ . '/../vendor/autoload.php';

    // 4. Bootstrap Laravel
    $app = require_once __DIR__ . '/../bootstrap/app.php';

    // 5. Override Storage Path
    $app->useStoragePath($storagePath);

    // 6. Handle Request
    $app->handleRequest(Illuminate\Http\Request::capture());

} catch (\Throwable $e) {
    echo "<h1>Vercel Deployment Error</h1>";
    echo "<p><b>Message:</b> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><b>File:</b> " . $e->getFile() . " on line " . $e->getLine() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}

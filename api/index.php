<?php
/**
 * Vercel Bridge for Laravel 11/12
 */

// 1. Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');

try {
    // 2. Paths
    $root = realpath(__DIR__ . '/..');
    $basePath = $root . '/frontend';
    $storagePath = '/tmp/storage';

    // 3. Autoloader
    if (!file_exists($root . '/vendor/autoload.php')) {
        throw new \Exception("Autoloader not found at " . $root . '/vendor/autoload.php');
    }
    require $root . '/vendor/autoload.php';

    // 4. Set Environment
    $_ENV['APP_BASE_PATH'] = $basePath;
    $_ENV['APP_STORAGE_PATH'] = $storagePath;
    putenv("APP_BASE_PATH=$basePath");
    putenv("APP_STORAGE_PATH=$storagePath");

    // 5. Ensure Storage Structure
    foreach (['/framework/views', '/framework/cache', '/framework/sessions', '/logs'] as $path) {
        if (!is_dir($storagePath . $path)) {
            @mkdir($storagePath . $path, 0755, true);
        }
    }

    // 6. Bootstrap
    $app = require_once $basePath . '/bootstrap/app.php';

    // 7. Manual Path Overrides (Defensive)
    $app->useStoragePath($storagePath);
    $app->instance('path.config', $basePath . '/config');
    $app->instance('path.public', $basePath . '/public');
    
    // 8. Handle
    $app->handleRequest(Illuminate\Http\Request::capture());

} catch (\Throwable $e) {
    echo "<h1>Deployment Error</h1>";
    echo "<p><b>Message:</b> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><b>File:</b> " . $e->getFile() . " on line " . $e->getLine() . "</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}

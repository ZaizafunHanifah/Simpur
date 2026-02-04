<?php

$backendPath = __DIR__ . '/../backend';
$vendorPath = $backendPath . '/vendor';

// Ensure dependencies are installed
if (!file_exists($vendorPath . '/autoload.php')) {
    // Try to run composer install if composer exists
    $composerPaths = [
        '/usr/local/bin/composer',
        'composer',
        'php -r "require phar://composer.phar/src/bootstrap.php;"'
    ];
    
    foreach ($composerPaths as $cmd) {
        if (shell_exec("which composer 2>/dev/null")) {
            shell_exec("cd $backendPath && composer install --no-dev --optimize-autoloader 2>&1");
            break;
        }
    }
}

// Load Composer autoloader
require_once $vendorPath . '/autoload.php';

// Set environment variables
putenv('APP_ENV=production');
putenv('APP_DEBUG=false');

// Load Laravel application
require $backendPath . '/bootstrap/app.php';

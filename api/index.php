<?php

// Vercel PHP entry point
// Routes all requests to the backend Laravel application

$backendPath = realpath(__DIR__ . '/../backend');

define('LARAVEL_START', microtime(true));

// Check maintenance mode
if (file_exists($maintenance = $backendPath . '/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register Composer autoloader
$vendorAutoload = $backendPath . '/vendor/autoload.php';
$rootAutoload = realpath(__DIR__ . '/../vendor/autoload.php');

if (file_exists($vendorAutoload)) {
    require $vendorAutoload;
} elseif (file_exists($rootAutoload)) {
    require $rootAutoload;
} else {
    http_response_code(500);
    echo "Dependencies not installed. Autoloader not found at:<br>";
    echo "- " . $vendorAutoload . "<br>";
    echo "- " . $rootAutoload . "<br>";
    die("Run 'composer install' locally and commit vendor/ or ensure root composer.json is correct.");
}

// Bootstrap Laravel
$app = require_once $backendPath . '/bootstrap/app.php';

// Handle the request using Laravel's native handler
$app->handleRequest(\Illuminate\Http\Request::capture());

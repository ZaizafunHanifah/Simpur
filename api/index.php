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
if (!file_exists($vendorAutoload)) {
    http_response_code(500);
    die("Dependencies not installed. Run 'composer install' in the backend folder.");
}
require $vendorAutoload;

// Bootstrap Laravel
$app = require_once $backendPath . '/bootstrap/app.php';

// Handle the request using Laravel's native handler
$app->handleRequest(\Illuminate\Http\Request::capture());

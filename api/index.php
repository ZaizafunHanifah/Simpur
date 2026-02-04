<?php

// Vercel PHP entry point
// Routes all requests to the backend Laravel application

$backendPath = realpath(__DIR__ . '/../backend');
$vendorAutoload = $backendPath . '/vendor/autoload.php';

// If Composer dependencies are not installed, return a clear 500
if (!file_exists($vendorAutoload)) {
    http_response_code(500);
    echo "Dependencies not installed. Please enable composer install in your Vercel build (set `installCommand` to `cd backend && composer install`) or run `composer install` locally and push the `vendor` folder.`";
    exit;
}

require_once $vendorAutoload;

// Create kernel and handle request
$app = require $backendPath . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\\Contracts\\Http\\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\\Http\\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);

<?php

// Vercel PHP entry point
// Routes all requests to the backend Laravel application

$backendPath = realpath(__DIR__ . '/../backend');

// Create kernel and handle request
$app = require $backendPath . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);

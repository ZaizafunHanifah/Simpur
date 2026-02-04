<?php

// Set application paths
$appPath = __DIR__ . '/../backend';
$publicPath = $appPath . '/public';

// Set environment variables
putenv('APP_ENV=production');
putenv('APP_DEBUG=false');

// Load Laravel application
require $appPath . '/bootstrap/app.php';

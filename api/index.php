<?php

// Load Composer autoloader dari backend
require_once __DIR__ . '/../backend/vendor/autoload.php';

// Set application paths
$appPath = __DIR__ . '/../backend';

// Set environment variables
putenv('APP_ENV=production');
putenv('APP_DEBUG=false');

// Load Laravel application
require $appPath . '/bootstrap/app.php';

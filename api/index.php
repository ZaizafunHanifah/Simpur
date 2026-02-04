<?php
// Vercel entry point from Root
// When composer.json is in root, vendor is also in root
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../frontend/public/index.php';

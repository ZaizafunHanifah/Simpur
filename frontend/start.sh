#!/bin/sh
set -x

echo "--- STARTING FRONTEND STARTUP SCRIPT ---"

# 1. Pastikan file .env ada
if [ ! -f .env ]; then
    echo "Creating .env file..."
    touch .env
fi

# 2. Generate APP_KEY
if [ -z "$APP_KEY" ]; then
    echo "Generating APP_KEY..."
    php artisan key:generate --force
fi

# 3. Diagnostic Backend URL
if [ -n "$BACKEND_URL" ]; then
    echo "Backend Hub: $BACKEND_URL"
    curl -I -s --connect-timeout 5 "$BACKEND_URL" || echo "Backend check skipped"
else
    echo "WARNING: BACKEND_URL is not set!"
fi

# 4. Clear Cache & Forced Session
echo "Preparing Laravel Environment..."
export SESSION_DRIVER=file
php artisan config:clear
php artisan view:clear
php artisan route:clear

# 5. Permissions (Standard but thorough)
echo "Setting permissions..."
chmod -R 777 storage bootstrap/cache public/build

# 6. Check files
ls -la server.php public/index.php

# 7. Start Server (Mirroring WORKING Backend command)
echo "Starting frontend server on port $PORT..."
php -S 0.0.0.0:$PORT server.php

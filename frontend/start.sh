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

# 3. Diagnostic Backend Connectivity
if [ -n "$BACKEND_URL" ]; then
    echo "Testing connectivity to Backend: $BACKEND_URL"
    curl -o /dev/null -s -w "%{http_code}" --connect-timeout 5 "$BACKEND_URL" && echo " | Backend is REACHABLE"
else
    echo "WARNING: BACKEND_URL is not set!"
fi

# 4. Permissions
echo "Setting permissions..."
chmod -R 777 storage bootstrap/cache public/build
chown -R www-data:www-data storage bootstrap/cache

# 5. Clear Cache & Forced Session
echo "Preparing Laravel Environment..."
export SESSION_DRIVER=file
php artisan config:clear
php artisan view:clear
php artisan route:clear

# 6. Check assets
echo "Checking build assets..."
ls -R public/build || echo "Build assets not found!"

# 7. Jalankan server (TANPA EXEC, samakan dengan Backend log yang sukses)
echo "Starting frontend server on port $PORT..."
php -S 0.0.0.0:$PORT server.php

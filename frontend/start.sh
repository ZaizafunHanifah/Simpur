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
    curl -I -s --connect-timeout 5 "$BACKEND_URL" || echo "WARNING: Backend is NOT reachable from this container!"
else
    echo "WARNING: BACKEND_URL is not set!"
fi

# 4. Clear Cache & Forced Session
echo "Preparing Laravel Environment..."
export SESSION_DRIVER=file
php artisan config:clear
php artisan view:clear
php artisan route:clear

# 5. Check assets
echo "Checking build assets..."
ls -R public/build || echo "Build assets not found!"

# 6. Jalankan server (Gunakan -t public)
echo "Starting frontend server on port $PORT..."
exec php -S 0.0.0.0:$PORT -t public

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

# 3. Check assets
echo "Checking build assets..."
ls -R public/build || echo "Build assets not found!"

# 4. Jalankan server (Gunakan server.php di root)
echo "Starting frontend server on port $PORT..."
php -S 0.0.0.0:$PORT server.php

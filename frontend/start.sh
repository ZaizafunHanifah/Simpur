#!/bin/sh
set -x

echo "--- STARTING FRONTEND STARTUP SCRIPT ---"

# 1. Pastikan file .env ada (Hanya formalitas untuk Laravel)
if [ ! -f .env ]; then
    echo "Creating .env file..."
    touch .env
fi

# 2. Generate APP_KEY
if [ -z "$APP_KEY" ]; then
    echo "Generating APP_KEY..."
    php artisan key:generate --force
fi

# 3. Jalankan server (Entry point utama)
echo "Starting server on port $PORT..."
php -S 0.0.0.0:$PORT server.php

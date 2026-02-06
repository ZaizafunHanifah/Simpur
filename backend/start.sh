#!/bin/sh

# 1. Pastikan file .env ada
if [ ! -f .env ]; then
    echo "Creating .env file..."
    touch .env
fi

# 2. Generate APP_KEY jika belum ada (hanya jika APP_KEY kosong di env)
if [ -z "$APP_KEY" ]; then
    echo "Generating APP_KEY..."
    php artisan key:generate --force
fi

# 3. Jalankan migrasi dan seeder (Hanya di Backend)
echo "Running migrations and seeders..."
php artisan migrate --force
php artisan db:seed --force

# 4. Jalankan server asli PHP dengan router Laravel agar tidak 404/502
echo "Starting server on port $PORT..."
php -S 0.0.0.0:$PORT vendor/laravel/framework/src/Illuminate/Foundation/resources/server.php

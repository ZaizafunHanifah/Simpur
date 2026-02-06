#!/bin/sh

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

# 3. Jalankan migrasi dan seeder
echo "Starting Database Migration..."
php artisan migrate --force

echo "Starting Database Seeding..."
php artisan db:seed --force

# 4. Jalankan server asli PHP dengan router Laravel
echo "Starting server on port $PORT..."
# Gunakan router resmi Laravel 11/12
php -S 0.0.0.0:$PORT vendor/laravel/framework/src/Illuminate/Foundation/resources/server.php

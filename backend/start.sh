#!/bin/sh
set -x

# 1. Pastikan file .env ada
if [ ! -f .env ]; then
    echo "Creating .env file..."
    touch .env
fi

# 2. Generate APP_KEY
echo "Current APP_KEY: $APP_KEY"
if [ -z "$APP_KEY" ]; then
    echo "Generating APP_KEY..."
    php artisan key:generate --force
fi

# 3. Jalankan migrasi dan seeder
echo "Starting Database Migration..."
php artisan migrate --force

echo "Starting Database Seeding..."
php artisan db:seed --force

# 4. Jalankan server
echo "Starting server on port $PORT..."
php -S 0.0.0.0:$PORT server.php

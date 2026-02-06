#!/bin/sh
set -x

echo "--- STARTING BACKEND STARTUP SCRIPT ---"

# 1. Pastikan file .env ada
if [ ! -f .env ]; then
    echo "Creating .env file..."
    touch .env
fi

# 2. Generate APP_KEY jika belum ada (Bisa dari env Railway atau otomatis)
if [ -z "$APP_KEY" ]; then
    echo "Generating APP_KEY..."
    php artisan key:generate --force
fi

# 3. Jalankan migrasi dan seeder
# Kita biarkan lanjut walaupun seeder gagal (robustus)
echo "Starting Database Migration..."
php artisan migrate --force

echo "Starting Database Seeding..."
php artisan db:seed --force -v || echo "Seeding encountered an issue but continuing to start server..."

# 4. Jalankan server (Entry point utama)
echo "Starting server on port $PORT..."
php -S 0.0.0.0:$PORT server.php

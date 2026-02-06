#!/bin/sh
# Mode debug: Berhenti jika ada error (-e) dan tampilkan setiap perintah (-x)
set -xe

echo "--- STARTING BACKEND STARTUP SCRIPT ---"

# 1. Pastikan file .env ada
if [ ! -f .env ]; then
    echo "Creating .env file..."
    touch .env
fi

# 2. Generate APP_KEY jika belum ada di variabel env Railway
if [ -z "$APP_KEY" ]; then
    echo "Generating APP_KEY..."
    php artisan key:generate --force
else
    echo "APP_KEY already set in environment."
fi

# 3. Jalankan migrasi dan seeder
echo "Starting Database Migration..."
php artisan migrate --force

echo "Starting Database Seeding..."
# Tambah verbose (-v) agar error terlihat jelas di log
php artisan db:seed --force -v

# 4. Jalankan server
echo "Starting server on port $PORT..."
php -S 0.0.0.0:$PORT server.php

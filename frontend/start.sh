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

# 3. Build assets (Jika belum ter-build di Dockerfile atau butuh rebuild dengan env Railway)
# Kadang VITE_API_URL butuh build di runtime jika tidak di-pass saat build time
# Tapi kita coba jalankan server dulu. 
# Jika UI kosong, mungkin perlu npm run build di sini.

# 4. Jalankan server
echo "Starting server on port $PORT..."
php -S 0.0.0.0:$PORT server.php

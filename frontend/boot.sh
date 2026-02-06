#!/bin/sh
set -x

echo "--- SIMPUR FRONTEND BOOT (V2) ---"

# 1. Pastikan file .env ada
if [ ! -f .env ]; then
    echo "Creating .env file..."
    touch .env
fi

# 2. Generate APP_KEY
if [ -z "$APP_KEY" ]; then
    echo "Generating APP_KEY... (Current: $APP_KEY)"
    php artisan key:generate --force
fi

# 3. Clear Cache
echo "Preparing Laravel..."
export SESSION_DRIVER=file
php artisan config:clear
php artisan view:clear
php artisan route:clear

# 4. Permissions
echo "Setting Permissions..."
chmod -R 777 storage bootstrap/cache public/build
chown -R www-data:www-data storage bootstrap/cache

# 5. Diagnostic
echo "Running on Port: $PORT"
echo "Backend URL: $BACKEND_URL"

# 6. Start Server (No-router mode, direct target)
echo "Starting frontend server..."
# Jalankan di background sebentar untuk memastikan shell tetap hidup jika crash
php -S 0.0.0.0:$PORT -t public/ &
PHP_PID=$!

# Tunggu sebentar
sleep 2

# Cek apakah PHP masih hidup
if ps -p $PHP_PID > /dev/null; then
    echo "PHP Server started successfully with PID $PHP_PID"
    wait $PHP_PID
else
    echo "FATAL: PHP Server failed to start!"
    ls -la public/index.php
    php -v
    exit 1
fi

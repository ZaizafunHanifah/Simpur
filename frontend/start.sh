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

# 3. Jalankan server asli PHP dengan router Laravel
echo "Starting server on port $PORT..."
php -S 0.0.0.0:$PORT vendor/laravel/framework/src/Illuminate/Foundation/resources/server.php

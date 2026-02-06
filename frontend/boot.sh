#!/bin/sh
set -x

echo "--- SIMPUR FRONTEND BOOT ---"

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

# 3. Environment Check
echo "Backend URL: $BACKEND_URL"

# 4. Clear Cache
echo "Preparing Laravel..."
export SESSION_DRIVER=file
php artisan config:clear
php artisan view:clear
php artisan route:clear

# 5. Permissions
echo "Setting Permissions..."
chmod -R 777 storage bootstrap/cache public/build

# 6. Check entry point
ls -la server.php public/index.php

# 7. Start Server (Standard Mode)
echo "Starting frontend server on port $PORT..."
# Gunakan exec agar log tersalurkan dengan benar
exec php -S 0.0.0.0:$PORT server.php

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

# 3. Diagnostic Backend URL
if [ -n "$BACKEND_URL" ]; then
    echo "Backend URL: $BACKEND_URL"
else
    echo "WARNING: BACKEND_URL is not set!"
fi

# 4. Permissions
echo "Setting permissions..."
chmod -R 777 storage bootstrap/cache public/build
find storage -type d -exec chmod 777 {} +
find storage -type f -exec chmod 666 {} +

# 5. Clear Cache
echo "Preparing Laravel Environment..."
export SESSION_DRIVER=file
php artisan config:clear
php artisan view:clear
php artisan route:clear

# 6. Check files
echo "Directory content check:"
ls -F public/
ls -F public/index.php

# 7. Start Server (Ultimate Standard Mode)
echo "Starting frontend server on port $PORT..."
# Gunakan exec dan -t public agar PHP menangani request dengan benar
exec php -S 0.0.0.0:$PORT -t public -d display_errors=1 -d error_reporting=E_ALL

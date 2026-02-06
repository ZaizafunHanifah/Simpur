#!/bin/sh
set -x

echo "--- SIMPUR FRONTEND ULTIMATE BOOT ---"

# 1. Env & Key
[ -f .env ] || touch .env
if [ -z "$APP_KEY" ]; then
    echo "Generating APP_KEY..."
    php artisan key:generate --force
fi

# 2. Force Production Settings for Stability
export SESSION_DRIVER=file
export APP_DEBUG=false
export LOG_CHANNEL=stderr

# 3. Laravel Prep
echo "Preparing Laravel..."
php artisan config:clear
php artisan view:clear
php artisan route:clear

# 4. Permissions
echo "Fixing Permissions..."
mkdir -p bootstrap/cache public/build storage/{app,framework/cache,framework/sessions,framework/views,logs}
chmod -R 777 storage bootstrap/cache public/build

# 5. Diagnostic
echo "Running on Port: $PORT"
echo "Backend URL: $BACKEND_URL"

# 6. Start Server (Mirroring WORKING Backend command + verbose errors)
echo "Starting Frontend server on port $PORT..."
# Gunakan exec agar PHP menjadi proses utama (PID 1)
exec php -S 0.0.0.0:$PORT server.php -d display_errors=1 -d error_reporting=E_ALL

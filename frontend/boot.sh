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
export APP_DEBUG=true
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


# 6. Diagnostics (Internal Check)
echo "Contents of public directory:"
ls -F public/
echo "Contents of public/build:"
ls -R public/build/ || echo "No build directory found"

# 7. Start Server (Using Official Artisan Serve)
echo "Final check: Listening on PORT $PORT"
echo "Starting Frontend server..."
# Gunakan exec agar PHP menjadi proses utama (PID 1)
exec php artisan serve --host=0.0.0.0 --port=${PORT:-8080}

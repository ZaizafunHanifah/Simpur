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
if [ -z "$BACKEND_URL" ]; then
    echo "WARNING: BACKEND_URL is not set. Frontend might fail to fetch data."
else
    echo "BACKEND_URL is set to: $BACKEND_URL"
fi

# 4. Diagnostic Database (Optional for Frontend but good to check)
echo "Checking Database Connection from Frontend..."
php -r "
try {
    \$host = getenv('DB_HOST');
    if (!\$host) throw new Exception('DB_HOST is empty');
    \$port = getenv('DB_PORT');
    \$db   = getenv('DB_DATABASE') ?: getenv('MYSQL_DATABASE');
    \$user = getenv('DB_USERNAME') ?: getenv('MYSQL_USER');
    \$pass = getenv('DB_PASSWORD') ?: getenv('MYSQL_PASSWORD');
    \$pdo = new PDO(\"mysql:host=\$host;port=\$port;dbname=\$db\", \$user, \$pass);
    echo 'Frontend -> DB Connection Successful' . PHP_EOL;
} catch (Exception \$e) {
    echo 'Frontend -> DB Connection Skipped/Failed (Non-critical): ' . \$e->getMessage() . PHP_EOL;
}"

# 5. Clear Cache & Ensure Session Driver
echo "Preparing Laravel Environment..."
export SESSION_DRIVER=file
php artisan config:clear
php artisan view:clear
php artisan route:clear

# 6. Check assets
echo "Checking build assets..."
ls -R public/build || echo "Build assets not found!"

# 7. Jalankan server
echo "Starting frontend server on port $PORT..."
exec php -S 0.0.0.0:$PORT server.php

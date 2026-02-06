#!/bin/sh
set -x

echo "--- STARTING BACKEND STARTUP SCRIPT ---"

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

# 3. Diagnostic Database (Gunakan getenv bukan env)
echo "Checking Database Connection..."
php -r "
try {
    \$host = getenv('DB_HOST');
    \$port = getenv('DB_PORT');
    \$db   = getenv('DB_DATABASE');
    \$user = getenv('DB_USERNAME');
    \$pass = getenv('DB_PASSWORD');
    \$pdo = new PDO(\"mysql:host=\$host;port=\$port;dbname=\$db\", \$user, \$pass);
    echo 'Connection Successful' . PHP_EOL;
} catch (PDOException \$e) {
    echo 'Connection Failed: ' . \$e->getMessage() . PHP_EOL;
}"

# 4. Jalankan migrasi dan seeder
echo "Starting Database Migration..."
php artisan migrate --force

echo "Starting Database Seeding..."
php artisan db:seed --force -v || echo "Seeding encountered an issue but continuing to start server..."

# 5. Jalankan server
echo "Starting server on port $PORT..."
php -S 0.0.0.0:$PORT server.php

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

# 3. Diagnostic Database (Frontend tetap butuh akses DB untuk session/data)
echo "Checking Database Connection from Frontend..."
php -r "
try {
    \$host = getenv('DB_HOST');
    \$port = getenv('DB_PORT');
    \$db   = getenv('DB_DATABASE') ?: getenv('MYSQL_DATABASE');
    \$user = getenv('DB_USERNAME') ?: getenv('MYSQL_USER');
    \$pass = getenv('DB_PASSWORD') ?: getenv('MYSQL_PASSWORD');
    \$pdo = new PDO(\"mysql:host=\$host;port=\$port;dbname=\$db\", \$user, \$pass);
    echo 'Frontend -> DB Connection Successful' . PHP_EOL;
} catch (PDOException \$e) {
    echo 'Frontend -> DB Connection Failed: ' . \$e->getMessage() . PHP_EOL;
}"

# 4. Clear Cache
echo "Clearing Laravel Cache..."
php artisan config:clear
php artisan view:clear
php artisan route:clear

# 5. Check assets
echo "Checking build assets..."
ls -R public/build || echo "Build assets not found!"

# 6. Jalankan server (Gunakan exec agar PHP jadi proses utama)
echo "Starting frontend server on port $PORT..."
exec php -S 0.0.0.0:$PORT server.php

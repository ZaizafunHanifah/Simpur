# GUNAKAN PHP-CLI (SANGAT STABIL DI RAILWAY)
FROM php:8.4-cli

# 1. Install extension installer & extensions
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions pdo_mysql mbstring exif pcntl bcmath gd zip

# 2. Install dasar
RUN apt-get update && apt-get install -y \
    zip unzip git curl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

# 3. Copy data
COPY . .

# 4. Install Composer & Dependencies
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --optimize-autoloader --no-dev

# 5. Permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 6. Jalankan menggunakan built-in server langsung (Bypass artisan serve bug)
EXPOSE 8080
CMD php -S 0.0.0.0:$PORT -t public

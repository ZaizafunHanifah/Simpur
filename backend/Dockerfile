# DOCKERFILE BACKEND (STABIL & ROBUST)
FROM php:8.4-cli

# 1. Install extension installer & extensions
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions pdo_mysql mbstring exif pcntl bcmath gd zip intl

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
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod +x /var/www/html/start.sh

# 6. Startup
CMD ["/var/www/html/start.sh"]

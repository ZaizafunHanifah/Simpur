# DOCKERFILE FRONTEND (FINAL STABILIZATION 2026-02-06-2330)
FROM php:8.4-cli

# 1. Node.js & PHP setup
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get update && apt-get install -y nodejs zip unzip git curl procps \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Install extensions
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions pdo_mysql mbstring exif pcntl bcmath gd zip intl

WORKDIR /var/www/html

# 3. Copy data
COPY . .

# 4. Install Composer, NPM, & Build
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --optimize-autoloader --no-dev && npm install && npm run build

# 5. Permissions & Format Fix (Crucial for Windows dev)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod +x /var/www/html/boot.sh && \
    sed -i 's/\r$//' /var/www/html/boot.sh

# 6. Startup
CMD ["/var/www/html/boot.sh"]

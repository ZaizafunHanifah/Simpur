# MULTI-STAGE BUILD UNTUK OPTIMALISASI
FROM php:8.4-apache as base

# 1. Install extension installer & extensions
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions pdo_mysql mbstring exif pcntl bcmath gd zip

# 2. Install dasar (tanpa modul PHP tambahan agar tidak bentrok MPM)
RUN apt-get update && apt-get install -y \
    zip unzip git curl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 3. Konfigurasi Apache (Minimal)
RUN a2enmod rewrite
# PENTING: Jangan sentuh MPM secara manual di sini, biarkan default image yang bekerja

WORKDIR /var/www/html

# 4. Copy data
COPY . .

# 5. Install Composer & Dependencies
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --optimize-autoloader --no-dev

# 6. Permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 7. Port & DocumentRoot
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN sed -i 's/Listen 80/Listen 8080/g' /etc/apache2/ports.conf
RUN sed -i 's/:80/:8080/g' /etc/apache2/sites-available/*.conf

EXPOSE 8080
CMD ["apache2-foreground"]

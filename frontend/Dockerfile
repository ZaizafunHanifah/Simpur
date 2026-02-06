# Use PHP 8.4 with Apache
FROM php:8.4-apache

# Install nodejs
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get update && apt-get install -y nodejs

# Use the official PHP extension installer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

# Install PHP extensions and their system dependencies automatically
RUN install-php-extensions pdo_mysql mbstring exif pcntl bcmath gd zip

# Install other system dependencies
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    curl

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Aggressive Apache MPM fix: Remove all and enable only prefork
RUN rm -rf /etc/apache2/mods-enabled/mpm_*.load /etc/apache2/mods-enabled/mpm_*.conf && \
    a2enmod mpm_prefork && \
    a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy files
COPY . .

# Install dependencies and build assets
RUN composer install --optimize-autoloader --no-dev && npm install && npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Update Apache DocumentRoot to Laravel public folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Set port to 8081
RUN sed -i 's/Listen 80/Listen 8081/g' /etc/apache2/ports.conf
RUN sed -i 's/:80/:8081/g' /etc/apache2/sites-available/*.conf

# Expose port
EXPOSE 8081

# Start Apache
CMD ["apache2-foreground"]

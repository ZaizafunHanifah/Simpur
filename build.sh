#!/bin/bash
set -e

echo "Installing backend dependencies..."
cd backend

# Download composer if not exists
if [ ! -f composer.phar ]; then
    echo "Downloading Composer..."
    curl -sS https://getcomposer.org/installer | php -- --install-dir=.
fi

# Run composer install
php composer.phar install --no-dev --optimize-autoloader
echo "Backend dependencies installed successfully!"

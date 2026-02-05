#!/bin/bash
set -e

echo "Installing backend dependencies..."
cd backend
composer install --no-dev --optimize-autoloader
echo "Backend dependencies installed successfully!"

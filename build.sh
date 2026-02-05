#!/bin/bash
set -e

echo "--- Starting Build Process ---"

# 1. Handle Backend Assets
echo "Building Backend assets..."
if [ -d "backend" ]; then
    cd backend
    if [ -f "package.json" ]; then
        npm install
        npm run build
    fi
    cd ..
else
    echo "Warning: backend directory not found."
fi

# 2. Handle Frontend Assets
echo "Building Frontend assets..."
if [ -d "frontend" ]; then
    cd frontend
    if [ -f "package.json" ]; then
        npm install
        npm run build
    fi
    cd ..
else
    echo "Warning: frontend directory not found."
fi

# 3. PHP Dependencies Note
echo "Note: PHP dependencies are NOT installed during this build phase."
echo "They will be handled by the Vercel PHP runtime using the root composer.json."
echo "If you encounter issues, ensure 'backend/vendor' is committed or the root composer.json is complete."

echo "--- Build Process Completed ---"
exit 0

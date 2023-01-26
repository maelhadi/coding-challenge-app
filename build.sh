#!/bin/sh

echo "Installing PHP dependencies..."
composer install

echo "Creating docker containers..."
docker compose up -d

echo "create .env file"
cp .env.local .env

echo "generate key"
php artisan key:generate


echo "Installing JavaScript dependencies..."
npm install

echo "Executing migrations..."
php artisan migrate

echo "Executing migrations on test database..."
php artisan migrate --env=testing

echo "Build complete!"

#!/bin/bash

# Exit immediately if a command exits with a non-zero status.
set -e

# Define the sail executable alias
# This assumes you have a 'sail' alias or run it via vendor/bin/sail
# Adjust if your sail command is different
SAIL="./vendor/bin/sail"

# Check if vendor directory exists, if not run composer install first
if [ ! -d "vendor" ]; then
    echo "Vendor directory not found. Running initial composer install..."
    # We need docker-compose for the initial install if vendor doesn't exist
    docker compose run --rm laravel.test composer install
fi

# Start Sail containers in the background
echo "Starting Sail containers..."
$SAIL up -d

# Wait a few seconds for containers (especially DB) to be ready
echo "Waiting for containers to initialize..."
sleep 10

# Install Composer dependencies
echo "Installing Composer dependencies..."
$SAIL composer install

# Install NPM dependencies
echo "Installing NPM dependencies..."
$SAIL npm install

# Build frontend assets (change 'build' if your script is different, e.g., 'dev')
echo "Building frontend assets..."
$SAIL npm run build

# Copy .env.example to .env if .env does not exist
if [ ! -f ".env" ]; then
    echo "Creating .env file..."
    cp .env.example .env
    # Generate application key after creating .env
    echo "Generating application key..."
    $SAIL artisan key:generate
else
    echo ".env file already exists."
    # Optional: Uncomment the line below if you want to ensure key:generate runs even if .env exists
    # $SAIL artisan key:generate
fi

# Run database migrations
echo "Running database migrations..."
$SAIL artisan migrate

# Seed the database
echo "Seeding the database..."
$SAIL artisan db:seed

echo "Setup complete! Application should be running." 
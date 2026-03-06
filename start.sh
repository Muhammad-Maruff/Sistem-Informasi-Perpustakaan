#!/bin/sh
# Convert PORT to integer
PORT_NUM=$((PORT))

# Run migrations
php artisan migrate --force

# (Optional) Run seeders if needed
# php artisan db:seed --force

# Start Laravel server
php artisan serve --host=0.0.0.0 --port=$PORT_NUM

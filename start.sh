#!/bin/sh
# Convert PORT to integer
PORT_NUM=$((PORT))
php artisan serve --host=0.0.0.0 --port=$PORT_NUM

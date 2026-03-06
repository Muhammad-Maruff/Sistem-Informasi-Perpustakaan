#!/bin/sh
# Convert PORT to integer
PORT_NUM=$((PORT))

# Run migrations with error handling
echo "Starting migration..."
php artisan migrate --force
MIGRATION_EXIT_CODE=$?

if [ $MIGRATION_EXIT_CODE -eq 0 ]; then
    echo "Migration completed successfully!"
else
    echo "Migration failed with exit code: $MIGRATION_EXIT_CODE"
    echo "Continuing anyway..."
fi

# (Optional) Run seeders if needed
# php artisan db:seed --force

# Start Laravel server
echo "Starting Laravel server on port $PORT_NUM..."
php artisan serve --host=0.0.0.0 --port=$PORT_NUM

#!/bin/sh
# Convert PORT to integer
PORT_NUM=$((PORT))

# Run migrations with error handling
echo "Starting migration..."
php artisan migrate --force
MIGRATION_EXIT_CODE=$?

if [ $MIGRATION_EXIT_CODE -eq 0 ]; then
    echo "Migration completed successfully!"
    
    # Run seeders to populate initial data (roles, categories, etc)
    echo "Running seeders..."
    php artisan db:seed --force
    SEEDER_EXIT_CODE=$?
    
    if [ $SEEDER_EXIT_CODE -eq 0 ]; then
        echo "Seeders completed successfully!"
    else
        echo "Seeders failed with exit code: $SEEDER_EXIT_CODE"
        echo "Continuing anyway..."
    fi
else
    echo "Migration failed with exit code: $MIGRATION_EXIT_CODE"
    echo "Continuing anyway..."
fi

# Start Laravel server
echo "Starting Laravel server on port $PORT_NUM..."
php artisan serve --host=0.0.0.0 --port=$PORT_NUM

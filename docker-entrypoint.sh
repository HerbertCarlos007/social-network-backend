#!/bin/bash
set -e
if [ ! -f /var/www/vendor/autoload.php ]; then
    echo "vendor/autoload.php not found. Running composer install..."
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

echo "PostgreSQL está pronto. Executando as migrations..."
php artisan migrate --force

echo "Iniciando o servidor embutido do PHP..."
exec php artisan serve --host=0.0.0.0 --port=8000

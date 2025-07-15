#!/bin/bash
set -e

echo "PostgreSQL está pronto. Executando as migrations..."
php artisan migrate --force

echo "Iniciando o servidor embutido do PHP..."
exec php artisan serve --host=0.0.0.0 --port=8000

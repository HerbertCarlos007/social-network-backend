FROM php:8.3.8-cli

WORKDIR /var/www

RUN apt-get update && apt-get upgrade -y && \
    apt-get install -y git libzip-dev unzip nano libpq-dev && \
    docker-php-ext-install zip pdo pdo_pgsql

COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

COPY . /var/www

# Instala o Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

RUN composer install --no-scripts --no-autoloader && \
    composer dump-autoload --optimize

RUN chmod -R 775 storage

ENTRYPOINT ["docker-entrypoint.sh"]

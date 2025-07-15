FROM php:8.3.8-cli

WORKDIR /var/www

RUN apt-get update && apt-get upgrade -y && \
    apt-get install -y git libzip-dev unzip nano libpq-dev postgresql-client && \
    docker-php-ext-install zip pdo pdo_pgsql && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Copia arquivos necessários para instalar dependências antes de copiar tudo (para aproveitar cache)
COPY composer.json composer.lock ./

# Instala o Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

# Instala as dependências do Laravel
RUN composer install --optimize-autoloader --no-dev

# Copia o restante do código da aplicação
COPY . /var/www

# Ajusta permissões para storage e bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Copia e dá permissão ao entrypoint
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]

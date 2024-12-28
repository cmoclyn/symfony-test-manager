FROM php:8.3-fpm

# Installer les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip libicu-dev libpq-dev \
    && docker-php-ext-install pdo pdo_mysql intl zip opcache

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Installer Symfony CLI (optionnel mais pratique pour Symfony)
RUN curl -sS https://get.symfony.com/cli/installer | bash && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

RUN pecl install xdebug && docker-php-ext-enable xdebug


# Configuration
COPY ./docker/php/php.ini /usr/local/etc/php/

WORKDIR /var/www

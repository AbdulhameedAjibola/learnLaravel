FROM laravelsail/php83-composer:latest

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip\
    && pecl install redis \
    && docker-php-ext-enable redis

WORKDIR /var/www/html
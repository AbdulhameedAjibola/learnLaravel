FROM laravelsail/php83-composer:latest

# Create sail user if missing
RUN addgroup --gid 1000 sail \
    && adduser --uid 1000 --gid 1000 --disabled-password --gecos "" sail

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip \
    && pecl install redis \
    && docker-php-ext-enable redis

WORKDIR /var/www/html

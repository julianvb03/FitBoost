FROM php:8.2-fpm-alpine

#LABEL org.opencontainers.image.source=""
#LABEL org.opencontainers.image.description=""

RUN apk add --no-cache \
    mysql-client \
    zip \
    unzip \
    git

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]
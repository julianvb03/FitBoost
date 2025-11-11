FROM php:8.2-apache

ARG APP_KEY="base64:AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA="

RUN apt-get update -y \
    && apt-get install -y --no-install-recommends \
        curl \
        git \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        unzip \
        zip \
    && docker-php-ext-install pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite \
    && sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/apache2.conf

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get update -y \
    && apt-get install -y --no-install-recommends nodejs \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

COPY composer.json composer.lock* ./
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --prefer-dist \
    --no-interaction \
    --no-progress \
    --no-scripts

COPY package.json package-lock.json* ./
RUN npm ci

COPY . .

RUN rm -f bootstrap/cache/packages.php bootstrap/cache/services.php \
    && APP_ENV=production APP_KEY="${APP_KEY}" php artisan package:discover --ansi --quiet

RUN NODE_ENV=production npm run build \
    && cp public/build/.vite/manifest.json public/build/manifest.json \
    && rm -rf node_modules

RUN ln -snf /var/www/html/storage/app/public /var/www/html/public/storage \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 80

CMD ["apache2-foreground"]
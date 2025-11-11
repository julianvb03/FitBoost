FROM php:8.2-apache

# Allow overriding the APP_KEY during build; default is a placeholder suitable only for compilation steps.
ARG APP_KEY="base64:AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA="

# Install system dependencies and PHP extensions needed by Laravel.
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

# Enable Apache mod_rewrite and point the document root to public/.
RUN a2enmod rewrite \
    && sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf \
    && sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/apache2.conf

# Install Composer and Node.js 20 for building frontend assets.
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get update -y \
    && apt-get install -y --no-install-recommends nodejs \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

# Install PHP dependencies without executing Composer scripts (artisan needs runtime env vars).
COPY composer.json composer.lock* ./
RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --prefer-dist \
    --no-interaction \
    --no-progress \
    --no-scripts

# Install Node dependencies in a reproducible way.
COPY package.json package-lock.json* ./
RUN npm ci

# Copy the application source code.
COPY . .

# Rebuild package manifests without dev-only service providers.
RUN rm -f bootstrap/cache/packages.php bootstrap/cache/services.php \
    && APP_ENV=production APP_KEY="${APP_KEY}" php artisan package:discover --ansi --quiet

# Build static assets, expose the manifest where Laravel expects it, and remove node_modules afterwards to slim the image.
RUN NODE_ENV=production npm run build \
    && cp public/build/.vite/manifest.json public/build/manifest.json \
    && rm -rf node_modules

# Create the public storage symlink and ensure writable directories.
RUN ln -snf /var/www/html/storage/app/public /var/www/html/public/storage \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 80

CMD ["apache2-foreground"]
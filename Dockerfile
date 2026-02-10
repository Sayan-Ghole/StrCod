# PHP 8.4 + Apache
FROM php:8.4-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git unzip curl \
    libzip-dev libpng-dev libonig-dev libxml2-dev \
    libjpeg-dev libfreetype6-dev libwebp-dev libxpm-dev \
    libicu-dev zlib1g-dev g++ \
    && rm -rf /var/lib/apt/lists/*

# PHP extensions
RUN docker-php-ext-configure gd --with-jpeg --with-freetype --with-webp --with-xpm
RUN docker-php-ext-install pdo pdo_mysql mbstring zip exif bcmath gd intl

# Enable Apache rewrite
RUN a2enmod rewrite

# Set Apache document root to /public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf \
    && sed -ri 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf

# Copy Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_MEMORY_LIMIT=-1

# Copy project files
COPY . .

# IMPORTANT: create required Laravel dirs
RUN mkdir -p storage/logs bootstrap/cache

# Install dependencies (NO scripts)
RUN composer install --no-dev --no-interaction --optimize-autoloader --no-scripts

# FIX PERMISSIONS (THIS IS THE BIG ONE)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Switch to Apache user
USER www-data

EXPOSE 80

CMD ["apache2-foreground"]

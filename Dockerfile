# Use PHP 8.4 with Apache
FROM php:8.4-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    curl \
    zlib1g-dev \
    libicu-dev \
    g++ \
    libjpeg-dev \
    libfreetype6-dev \
    libwebp-dev \
    libxpm-dev \
    && rm -rf /var/lib/apt/lists/*

# Configure GD
RUN docker-php-ext-configure gd --with-jpeg --with-freetype --with-webp --with-xpm

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring zip exif bcmath gd intl

# Enable Apache rewrite
RUN a2enmod rewrite

# Copy Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_MEMORY_LIMIT=-1
ENV COMPOSER_ALLOW_SUPERUSER=1

# Copy project files
COPY . .

# Install Composer dependencies without running Laravel scripts
RUN composer install --no-dev --no-interaction --optimize-autoloader --no-scripts

# ✅ Check and fix permissions (storage, bootstrap/cache, vendor)
RUN ls -la storage bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache vendor \
    && chmod -R 775 storage bootstrap/cache vendor

# ✅ Clear Laravel caches (won't fail if APP_KEY missing)
RUN php artisan config:clear || true
RUN php artisan route:clear || true
RUN php artisan view:clear || true

# Set Apache document root to public folder
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf \
    && sed -ri 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf

# Expose port 80
EXPOSE 80

# ✅ Clear caches at runtime & start Apache
CMD php artisan config:clear && php artisan route:clear && php artisan view:clear && apache2-foreground

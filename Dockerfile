# Use PHP 8.4 with Apache
FROM php:8.4-apache

# Set working directory early
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

# Configure GD for PHP
RUN docker-php-ext-configure gd --with-jpeg --with-freetype --with-webp --with-xpm

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring zip exif bcmath gd intl

# Enable Apache rewrite
RUN a2enmod rewrite

# Copy Composer from official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
ENV COMPOSER_MEMORY_LIMIT=-1

# Copy project files
COPY . .

# Fix permissions before Composer install
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Install Composer dependencies
RUN composer install --no-dev --no-interaction --optimize-autoloader

# Cache Laravel config/routes/views for production
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Set Apache document root to public folder
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf \
    && sed -ri 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf

# Expose port 80
EXPOSE 80

# Start Apache in foreground
CMD ["apache2-foreground"]
FROM bitnami/laravel:10

# Set working directory
WORKDIR /app

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install \
    --no-dev \
    --no-interaction \
    --optimize-autoloader

# Expose Apache port
EXPOSE 8080

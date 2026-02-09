FROM bitnami/laravel:latest

WORKDIR /app

COPY . .

RUN composer install --no-dev --no-interaction --optimize-autoloader

EXPOSE 8080

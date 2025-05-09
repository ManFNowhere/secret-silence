FROM php:8.2-fpm

# Install dependencies sistem & PHP
RUN apt-get update && apt-get install -y \
    git curl unzip zip libzip-dev libonig-dev libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Install Node.js (v18 LTS) + npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Salin semua file proyek ke container
COPY . .

# Pastikan direktori cache Laravel tersedia & permission benar
RUN mkdir -p storage/framework/views storage/framework/cache storage/framework/sessions \
&& chmod -R 775 storage bootstrap/cache

# Install dependencies Laravel
RUN composer install --optimize-autoloader --no-dev

# Install dan build frontend (Vite + Tailwind)
RUN npm install && npm run build

# Jalankan Laravel
CMD php artisan cache:clear \
&& php artisan config:clear \
&& php artisan view:clear \
&& php artisan migrate --force \
&& php artisan config:cache \
&& php artisan serve --host=0.0.0.0 --port=8000

EXPOSE 8000

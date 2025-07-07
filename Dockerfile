# Stage 1: Build stage
FROM php:8.2-cli as builder

WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql zip mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy only what's needed for composer install
COPY composer.json composer.lock ./

# Install dependencies (no dev dependencies)
RUN composer install --no-dev --no-interaction --optimize-autoloader

# Stage 2: Runtime stage
FROM php:8.2-cli

WORKDIR /var/www

# Install runtime dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Copy from builder stage
COPY --from=builder /var/www/vendor ./vendor
COPY . .

# Optimize Laravel
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# Set proper permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Switch to non-root user
USER www-data

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]

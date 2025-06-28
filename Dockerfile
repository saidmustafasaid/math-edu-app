FROM php:8.2-apache

# Install PHP extensions and dependencies
RUN apt-get update && apt-get install -y \
    zip unzip curl git libzip-dev libonig-dev libxml2-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set the working directory to Laravel root (not public yet)
WORKDIR /var/www

# Copy composer first (Docker caching)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy all project files
COPY . /var/www

# Point Apache to Laravel's public directory
ENV APACHE_DOCUMENT_ROOT=/var/www/public

# Update Apache config to use the public folder
RUN sed -ri -e 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/000-default.conf

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev

# Generate Laravel app key
RUN php artisan key:generate || true

# Set proper permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 80

CMD ["apache2-foreground"]


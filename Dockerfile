FROM php:8.2-apache

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Enable Apache modules
RUN a2enmod rewrite

# Set working directory to Laravel root
WORKDIR /var/www

# Copy Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# Set proper permissions
RUN chown -R www-data:www-data /var/www \
 && chmod -R 755 /var/www/storage /var/www/bootstrap/cache

# Set the Apache doc root to Laravel's public folder
ENV APACHE_DOCUMENT_ROOT=/var/www/public

# Update Apache config to use /public as the web root
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/public|g' /etc/apache2/sites-available/000-default.conf

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev

# Generate Laravel app key (optional, ignore error if .env missing)
RUN php artisan key:generate || true

EXPOSE 80

CMD ["apache2-foreground"]


# Use official PHP image with Apache
FROM php:8.3-apache

# Enable Apache mod_rewrite (important for Laravel routing)
RUN a2enmod rewrite

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    curl \
    libxml2-dev \
    gnupg \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql xml

# Install Node.js v18 and npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory inside the container
WORKDIR /var/www/html

# Copy project files to container
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

  # Set correct permissions for Laravel
RUN chown -R www-data:www-data storage bootstrap/cache
  
# Enable mod_rewrite
RUN a2enmod rewrite


# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Install Node modules and build assets
RUN npm install && npm run build

# Use custom virtual host config
COPY ./apache-config/000-default.conf /etc/apache2/sites-enabled/000-default.conf

# Expose HTTP and HTTPS ports
EXPOSE 80

# Start Apache when the container runs
CMD ["apache2-foreground"]

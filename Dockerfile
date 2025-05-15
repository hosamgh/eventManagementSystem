# Use official PHP image with Apache
FROM php:8.3-apache

# Enable Apache mod_rewrite (important for Laravel)
RUN a2enmod rewrite

# Install PHP extensions for Laravel and Vue.js
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql xml

    # Install Node.js (and npm) for Vue.js build process
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

# Install Composer for PHP dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory to Laravel app
WORKDIR /var/www/html

# Copy Laravel app into the container
COPY . /var/www/html

# Set proper permissions for Laravel files
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache


# Install JS dependencies and build
WORKDIR /var/www/html
# Install npm dependencies (Vue.js and other frontend packages)
RUN npm install

# Build the Vue.js frontend assets
RUN npm run build

# Expose ports for HTTP and HTTPS
EXPOSE 80
EXPOSE 443

# Start Apache server
CMD ["apache2-foreground"]

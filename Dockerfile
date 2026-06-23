# Use the official PHP image with Apache
FROM php:8.2-apache

# Install the MySQL extensions so PHP can talk to the database
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite (often needed for PHP routing)
RUN a2enmod rewrite

# Copy all your project files into the container's web directory
COPY . /var/www/html/

# Ensure correct permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose port 80 for Render
EXPOSE 80

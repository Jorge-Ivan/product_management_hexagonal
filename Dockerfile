# syntax=docker/dockerfile:1

################################################################################

# Create a stage for installing app dependencies defined in Composer.
FROM composer:lts as deps

# Set time zone -5
ENV TZ=America/Bogota

WORKDIR /app

# Copy the application source code into the container.
COPY . .

# Download dependencies as a separate step to take advantage of Docker's caching.
# Leverage a cache mount to /tmp/cache so that subsequent builds don't have to re-download packages.
RUN --mount=type=cache,target=/tmp/cache \
    composer install --no-interaction

################################################################################

# Create a new stage for running the application that contains the minimal
# runtime dependencies for the application. This often uses a different base
# image from the install or build stage where the necessary files are copied
# from the install stage.
FROM php:7.3-apache as final

# Install necessary PHP extensions and PostgreSQL client libraries
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libpq-dev \
    default-mysql-client \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy the app dependencies from the previous install stage.
COPY --from=deps /app/vendor /var/www/html/vendor

# Copy the app files from the app directory.
COPY . /var/www/html
COPY .env /var/www/html/.env

# Set appropriate permissions for Laravel
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Clear and cache configurations to prevent errors
RUN php artisan optimize

# Copy the Apache configuration file.
COPY ./docker/apache/vhost.conf /etc/apache2/sites-available/000-default.conf

# Set the working directory to the Laravel public folder
WORKDIR /var/www/html/public

# Use the default production configuration for PHP runtime arguments
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Expose port 80
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]

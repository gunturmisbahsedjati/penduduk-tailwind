FROM php:8.2-apache

# Install ekstensi mysqli untuk koneksi MySQL
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Enable mod_rewrite Apache
RUN a2enmod rewrite

COPY ./src /var/www/html/
EXPOSE 80
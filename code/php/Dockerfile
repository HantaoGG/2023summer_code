FROM php:8.1-apache
# COPY php.ini /usr/local/etc/php/php.ini
# RUN sed -i 's/output_buffering = Off/output_buffering = On/' /usr/local/etc/php/php.ini
RUN apt-get update -y && apt-get install -y libmariadb-dev && docker-php-ext-install mysqli && docker-php-ext-install pdo_mysql
WORKDIR /var/www/html
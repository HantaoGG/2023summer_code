FROM php:8.1-apache
RUN a2enmod rewrite
RUN chmod 777 ./ -R
RUN mkdir -p ./mysql/data
RUN mkdir -p /var/www/html/php/src/upload 
RUN mkdir -p .php/src/upload

COPY ./mysql/init.sql /docker-entrypoint-initdb.d/
RUN apt-get update -y && apt-get install -y libmariadb-dev && docker-php-ext-install mysqli && docker-php-ext-install pdo_mysql
WORKDIR /var/www/html

COPY entrypoint.sh /
RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
CMD ["apache2-foreground"]

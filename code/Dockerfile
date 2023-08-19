FROM php:8.1-apache

RUN a2enmod rewrite
RUN chmod 750 ./ -R
RUN mkdir -p ./mysql/data
COPY ./mysql/init.sql /docker-entrypoint-initdb.d/
RUN echo 'flag{xxx1}' > /flag1 \
    && echo 'flag{xxx2}' > /flag2 \
    && echo 'flag{xxx3}' > /flag3

RUN apt-get update -y && apt-get install -y libmariadb-dev

WORKDIR /var/www/html

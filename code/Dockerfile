FROM php:8.1-apache
RUN a2enmod rewrite
RUN mkdir -p ./mysql/data
# 创建upload目录
RUN mkdir -p /var/www/html/php/src/upload 
RUN mkdir -p .php/src/upload

COPY ./mysql/init.sql /docker-entrypoint-initdb.d/
RUN apt-get update -y && apt-get install -y libmariadb-dev && docker-php-ext-install mysqli && docker-php-ext-install pdo_mysql
WORKDIR /var/www/html

# 运行脚本
COPY permission.sh /usr/local/bin/
COPY entrypoint.sh /
COPY run.sh /usr/local/bin/

RUN chmod +x /usr/local/bin/permission.sh
RUN chmod +x /entrypoint.sh
RUN chmod +x /usr/local/bin/run.sh

ENTRYPOINT ["/usr/local/bin/run.sh"]

CMD []

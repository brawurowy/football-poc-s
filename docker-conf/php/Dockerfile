FROM php:7.1-fpm

RUN apt-get update && apt-get install -y zlib1g-dev libicu-dev g++ libcurl4-openssl-dev libpng-dev libjpeg-dev libmcrypt-dev less vim libpq-dev libxml2-dev && apt-get clean -y
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql pgsql intl curl gd mcrypt zip mbstring tokenizer xml sockets

RUN pecl install xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer config --global github-oauth.github.com 95b651e1d43110b5fdf050d78b67eed3a5f3aeac
FROM php:7.4-fpm-alpine
RUN apk add --no-cache $PHPIZE_DEPS openssl bash mysql-client nodejs npm
RUN docker-php-ext-install pdo pdo_mysql
RUN echo "upload_max_filesize = 100M" >> /usr/local/etc/php/conf.d/docker-php-ext-uploadsize.ini \
    && echo "post_max_size = 100M" >> /usr/local/etc/php/conf.d/docker-php-ext-uploadsize.ini

WORKDIR /var/www

RUN rm -rf /var/www/html
RUN ln -s public html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 9000

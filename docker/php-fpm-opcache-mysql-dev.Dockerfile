FROM php:8.2-fpm-alpine
RUN apk add curl libpq-dev
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN mkdir /var/app

RUN docker-php-ext-install pdo pdo_pgsql pdo_mysql

WORKDIR /var/app

COPY docker/config/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY docker/config/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

RUN chown -R www-data:www-data /var/app

CMD ["/usr/local/sbin/php-fpm", "-F"]
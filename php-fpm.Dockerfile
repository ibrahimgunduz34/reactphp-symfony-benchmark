FROM php:8.2-fpm-alpine
RUN apk add curl
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN mkdir /var/app

WORKDIR /var/app/public

COPY src /var/app/src
COPY public /var/app/public
COPY config /var/app/config
COPY bin /var/app/bin
#COPY var /var/app/var
COPY vendor /var/app/vendor
COPY composer.json /var/app/composer.json
COPY composer.lock /var/app/composer.lock

COPY .env /var/app/.env
COPY www.conf /usr/local/etc/php-fpm.d/www.conf

RUN chown -R www-data:www-data /var/app

CMD ["/usr/local/sbin/php-fpm", "-F"]
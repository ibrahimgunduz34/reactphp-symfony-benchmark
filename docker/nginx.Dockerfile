FROM nginx:latest

RUN rm /etc/nginx/conf.d/default.conf
COPY docker/config/nginx-php-fpm.conf /etc/nginx/conf.d/nginx-php-fpm.conf
CMD ["/usr/sbin/nginx", "-g", "daemon off;"]
FROM nginx:latest

RUN rm /etc/nginx/conf.d/default.conf
COPY nginx-php-fpm.conf /etc/nginx/conf.d/nginx-php-fpm.conf
CMD ["/usr/sbin/nginx", "-g", "daemon off;"]
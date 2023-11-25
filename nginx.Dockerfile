FROM nginx:latest

RUN rm /etc/nginx/conf.d/default.conf
COPY phpapp-nginx.conf /etc/nginx/conf.d/phpapp-nginx.conf
CMD ["/usr/sbin/nginx", "-g", "daemon off;"]
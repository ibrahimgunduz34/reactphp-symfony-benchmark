FROM nginx:latest

RUN rm /etc/nginx/conf.d/default.conf
COPY nginx-multiple-reactphp.conf /etc/nginx/conf.d/reactphpapp-nginx.conf
CMD ["/usr/sbin/nginx", "-g", "daemon off;"]
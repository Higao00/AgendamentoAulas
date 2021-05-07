FROM wyveo/nginx-php-fpm:latest
RUN rm -rf /usr/share/nginx/html
RUN ln -s public html
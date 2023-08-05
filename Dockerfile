FROM php:7.4-apache

##Cài đặt các phần mở rộng PHP cần thiết
RUN docker-php-ext-install mysqli pdo pdo_mysql

##Kích hoạt module rewrite của Apache
RUN a2enmod rewrite

##Thiết lập biến môi trường INCLUDE_PATH
ENV INCLUDE_PATH .:/path/to/.env

##Copy source vào thư mục /var/www/html trong container
COPY . /var/www/html/

##Copy tệp .env vào thư mục /var/www/html trong container
COPY .env /var/www/html/
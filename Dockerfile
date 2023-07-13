# Chọn hình ảnh cơ sở
FROM php:7.4-apache

# Cài đặt các phần mở rộng PHP cần thiết
RUN docker-php-ext-install mysqli pdo pdo_mysql

RUN a2enmod rewrite
ENV INCLUDE_PATH .:/path/to/.env
# Copy mã nguồn của bạn vào thư mục /var/www/html trong container
COPY . /var/www/html/

COPY .env /var/www/html/.env
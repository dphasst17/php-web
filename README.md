# php-web
Introduction
This is a web project that sells laptop and accessories products using Docker. The project includes a simple website that displays products and allows users to purchase them.

Requirements

#### Docker.
#### Docker Compose.

Clone the project into your computer.
Run the following command to create the containers:
docker-compose up -d
Access the website at http://localhost:8000.
Configuration
The project's settings are stored in the docker-compose.yml file. You can change these settings to suit your needs.

Learn more
To learn more about Docker, visit the Docker website: https://www.docker.com/


Products
This project sells laptop and accessories products, including:

### -Laptop.
### -Keyboard.
### -Mouse.
### -Storage.
### -Monitor.
### -Vga.
### -Ram.

The prices of the products are displayed on the website. Prices are in USD and are updated regularly.


Warranty
All products sold on the project are warranted for 12 months.

Customer support
The project provides customer support via email.

Contact
If you have any questions, please contact us via email.

## Dockerfile
Dockerfile is a text file that Docker uses to create a Docker image. A Docker image is a collection of packaged files that can be used to run a container.

Below is the Dockerfile for the web project that sells laptop and accessories products:
```
FROM php:7.4-apache

# Cài đặt các phần mở rộng PHP cần thiết
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Kích hoạt module rewrite của Apache
RUN a2enmod rewrite

# Thiết lập biến môi trường INCLUDE_PATH
ENV INCLUDE_PATH .:/path/to/.env

# Copy source vào thư mục /var/www/html trong container
COPY . /var/www/html/

# Copy tệp .env vào thư mục /var/www/html trong container
COPY .env /var/www/html/
```
This Dockerfile will install the PHP server. It will run the PHP server on port 8080.

docker-compose.yml
docker-compose.yml is a configuration file that Docker uses to create containers and networks.

Below is the docker-compose.yml file for the web project that sells laptop and accessories products:
```
version: '3'
services:
  # Định nghĩa dịch vụ PHP
  php:
    env_file: .env
    build:
      context: .
      dockerfile: Dockerfile
    volumes:
      - ./:/var/www/html
    ports:
      - 8080:80

  # Định nghĩa dịch vụ MySQL
  mysql:
    image: mysql:5.7
    environment:
      MYSQL_DATABASE: mydb
      MYSQL_USER: ${DB_USER}
      MYSQL_PASSWORD: ${DB_PASSWORD}
      MYSQL_ROOT_PASSWORD: ${DB_PASSWORD}
    volumes:
      - db_data:/var/lib/mysql

   # Định nghĩa dịch vụ phpMyAdmin
  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    ports:
      - 8081:80
    environment:
      PMA_HOST: mysql
      PMA_USER: ${DB_USER}
      PMA_PASSWORD: ${DB_PASSWORD}
Định nghĩa tập lệnh
volumes:
  db_data:
```
This docker-compose.yml file will create a container named web.
## Run the following command to start the services and start using them.
```
docker-compose build
```
## Start
To run the project, open a terminal in the directory that contains the Dockerfile and docker-compose.yml files. Then, run the following command:
```
docker-compose up -d
```
This command will create the containers and networks and then start them. The website will be accessible at http://localhost:8000.
To access phpAdmin, open a web browser and navigate to http://localhost:8081.

## Shutdown
To shutdown the project, run the following command:
```
docker-compose down
```

# Laravel CRUD 구현

-   PHP Version : PHP 8.2
-   PHP Framework : Laravel 10.10
-   Web Server : Nginx 3.18
-   Database : MariaDB 11.3.2

# 프로젝트 구조

/php
ᄂ laravel/
ᄂ Dockerfile
/nginx/
ᄂ default.conf
/mariadb/
ᄂ conf.d/
ᄂ data/
/docker-compose.yml

# /php/Dockerfile

FROM php:8.2-fpm-alpine
RUN docker-php-ext-install pdo pdo_mysql

# /nginx/default.conf

server {
listen 80;
server_name unani.com www.unani.com;
error_log /var/log/nginx/error.log;
access_log /var/log/nginx/access.log;
root /var/www/html/public;
index index.php index.html index.htm;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass php:9000;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param PATH_INFO $fastcgi_path_info;
    }

}

# /docker-compose.yml

version: "3"

networks:
laravel:

services:
nginx:
container_name: nginx
platform: linux/amd64
image: nginx:alpine3.18
ports: - "80:80"
volumes: - ./php/laravel:/var/www/html - ./nginx/default.conf:/etc/nginx/conf.d/default.conf
depends_on: - php - mariadb
networks: - laravel

mariadb:
container_name: mariadb
platform: linux/amd64
image: mariadb:11.3.2
restart: always
ports: - "3306:3306"
volumes: - ./mariadb/conf.d:/etc/mysql/conf.d - ./mariadb/data:/var/lib/mysql
environment:
MYSQL_DATABASE: mariadb
MYSQL_USER: unani
MYSQL_PASSWORD: RkRnd4591!
MYSQL_ROOT_PASSWORD: RkRnd4591!
networks: - laravel

php:
container_name: php
build:
context: .
dockerfile: ./php/Dockerfile
volumes: - ./php/laravel:/var/www/html
networks: - laravel

# Docker Container 생성

docker-compose build && docker-compose up -d

# Laravel 설치

cd ~/developments/learning/laravel.docker.study/php/laravel
composer create-project laravel/laravel .

# Laravel 프로젝트 실행

php artisan serve

# DB Table 만들기

-   boards 라는 테이블 만들기
    php artisan make:migration create_boards_table --create=boards

-   migrations 디렉토리로 이동
    cd laravel/database/migrations

-   생성된 2024_03_20_create_board_table.php > up 함수에 필요한 컬럼 추가 후 저장

-   migrate 실행
    php artisan migrate

-   Database 확인

# Controller 만들기

php artisan make:controller BoardsController --resource --model=Board

-   laravel/app/Http/Controller/BoardsController.php

public function index()
{
//
return view('boards.index');
}

-   laravel/routes/web.php
    Route::resource('boards', BoardsController::class);

-   laravel/resources/view/boards/index.module.php
    Hello World! 저장

# Browser 에서 확인

http://127.0.0.1:8000/boards

# 참고

https://laravel.com/docs/11.x/controllers#resource-controllers

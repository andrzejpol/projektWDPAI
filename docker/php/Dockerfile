FROM php:7.4.3-fpm-alpine3.11

RUN apk add --no-cache postgresql-dev

RUN docker-php-ext-install pdo pdo_pgsql

COPY . /app

VOLUME [ "/app" ]
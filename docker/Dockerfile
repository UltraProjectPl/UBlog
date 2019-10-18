FROM php:7.3-apache

RUN apt-get update -yqq && \
  apt-get install -yqq --no-install-recommends \
    apt-utils \
    libzip-dev zip unzip \
    git

RUN curl -o /usr/local/bin/composer https://getcomposer.org/composer.phar && chmod +x /usr/local/bin/composer

RUN docker-php-ext-install pdo_mysql

COPY blog.conf /etc/apache2/sites-available/
RUN a2enmod rewrite
RUN a2dissite 000-default && a2ensite blog

RUN usermod -u 1000 www-data

FROM mhart/alpine-node:11 AS builder
WORKDIR /app
COPY . .
RUN yarn run build

FROM mhart/alpine-node
RUN yarn global add serve
WORKDIR /app
COPY --from=builder /app/build .
CMD ["serve", "-p", "80", "-s", "."]

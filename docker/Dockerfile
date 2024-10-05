FROM php:8.3-cli-alpine3.17

WORKDIR /app

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions @composer opcache pdo_pgsql pgsql intl pcntl pcov && \
    ln -s composer /usr/local/bin/c

COPY composer.json composer.lock /app/
RUN composer install --optimize-autoloader --no-scripts --no-interaction --no-ansi

COPY . /app

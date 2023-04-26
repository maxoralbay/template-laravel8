FROM php:8.0.8-fpm-alpine3.13
# FROM php:8.1.0-fpm-alpine

ENV COMPOSER_ALLOW_SUPERUSER="1"

ENV PERMANENT_DEPS \
    postgresql-dev \
    composer \
    nginx \
    oniguruma-dev \
    libxml2-dev

RUN set -e \
    && apk add --quiet --no-cache ${PERMANENT_DEPS} > /dev/null \
    && docker-php-ext-install -j$(nproc) pdo_pgsql sockets bcmath intl mbstring dom > /dev/null \
    && docker-php-ext-configure bcmath --enable-bcmath > /dev/null \
    && docker-php-ext-configure mbstring --enable-mbstring > /dev/null \
    && rm -rf /var/cache/apk/* \
    && mkdir /app /home/user

COPY ./docker/entrypoint.sh /etc/entrypoint.sh
COPY ./docker/nginx/conf.d/ /etc/nginx/conf.d/
COPY ./docker/php/php.ini /etc/php8/php.ini
COPY --chown=www-data:www-data ./backend /app

ENV DB_CONNECTION pgsql

WORKDIR /app

RUN set -e \
    && composer install -n --no-ansi \
    # && composer update \
    && chmod +x /etc/entrypoint.sh


EXPOSE 9000

ENTRYPOINT ["/etc/entrypoint.sh"]
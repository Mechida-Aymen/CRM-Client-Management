# Stage 1: Composer build
FROM composer:2 AS builder

WORKDIR /app

ENV APP_ENV=prod
ENV APP_DEBUG=0

# Copy everything
COPY . .

RUN composer require phpstan/phpdoc-parser:"^1.7" --with-all-dependencies

# Install prod dependencies without dev or scripts
RUN COMPOSER_NO_DEV=1 COMPOSER_SKIP_EXTENSIONS_CHECK=1 composer install --optimize-autoloader --prefer-dist --no-scripts

# Stage 2: PHP-FPM image
FROM php:8.3-fpm-alpine

ENV APP_ENV=prod
ENV APP_DEBUG=0
ENV APP_HOME=/var/www/html

WORKDIR $APP_HOME

# Install PHP extensions
RUN apk add --no-cache \
    bash \
    icu-dev \
    libzip-dev \
    libxml2-dev \
    zlib-dev \
    oniguruma-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl pdo_mysql zip opcache \
    && rm -rf /var/cache/apk/*

# Copy built app from previous stage
COPY --from=builder /app $APP_HOME
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
# Fix permissions
RUN mkdir -p var/cache/prod var/log && \
    chown -R www-data:www-data var && \
    chmod -R 777 var

    RUN chmod +x /usr/local/bin/entrypoint.sh

RUN php bin/console importmap:install

USER www-data

EXPOSE 9000


ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]


CMD ["php-fpm"]

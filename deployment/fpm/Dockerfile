FROM php:8.1-fpm

ARG APP_ENV

ARG DOCKER_CONTAINER_UID
ARG DOCKER_CONTAINER_GID

RUN usermod  --uid $DOCKER_CONTAINER_UID www-data
RUN groupmod --gid $DOCKER_CONTAINER_GID www-data

RUN apt-get update && apt-get install -y --no-install-recommends libzip-dev libpng-dev libfreetype6-dev \
  libjpeg62-turbo-dev libmemcached-dev nano build-essential cron

RUN docker-php-ext-install -j$(nproc) pdo_mysql zip exif pcntl gd
RUN docker-php-ext-install mysqli

RUN apt-get install -y --no-install-recommends libssl-dev
RUN apt-get install zip unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY cron/laravel-cron /etc/cron.d/laravel_cron
RUN chmod 0644 /etc/cron.d/laravel_cron \
    && crontab /etc/cron.d/laravel_cron \
    && touch /var/log/cron.log

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN echo "memory_limit = 256M" >> "$PHP_INI_DIR/php.ini"
RUN echo "upload_max_filesize = 128M" >> "$PHP_INI_DIR/php.ini"
#RUN a2enmod rewrite

RUN echo 'zend_extension=xdebug' > /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo '[xdebug]' >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo 'xdebug.mode=develop,debug' >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo 'xdebug.client_host=host.docker.internal' >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo 'xdebug.start_with_request=yes' >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

CMD ["php-fpm"]

FROM php:7.4.9-fpm

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apt-get update && apt-get install -y libmcrypt-dev \
    default-mysql-client libmagickwand-dev --no-install-recommends \
    libcurl4-openssl-dev libssl-dev  libzip-dev libxml2-dev libonig-dev \
    && pecl install apcu  && docker-php-ext-enable apcu  \
    && pecl install raphf && docker-php-ext-enable raphf \
    && pecl install propro && docker-php-ext-enable propro \
    && pecl install pecl_http && docker-php-ext-enable http \
    && pecl install mongodb && docker-php-ext-enable mongodb opcache \
    && pecl install imagick && docker-php-ext-enable imagick \
    && docker-php-ext-install sockets \
    && docker-php-ext-install soap \
    && docker-php-ext-install -j5 gd mbstring mysqli pdo pdo_mysql shmop \
    && docker-php-ext-install zip \
    && docker-php-source delete


RUN pecl install xdebug  && docker-php-ext-enable xdebug  \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_autostart=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_port=9000" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_handler=dbgp" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_connect_back=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_host=10.20.30.23" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.PHP_IDE_CONFIG='serverName=php-fpm'" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN chown -R www-data:www-data /var/www



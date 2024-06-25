FROM php:8.2.11-fpm

# Установка Composer
RUN echo "\e[1;33mInstall COMPOSER\e[0m" \
    && cd /tmp \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Установка PHP расширений
RUN docker-php-ext-install pdo pdo_mysql

# Установка пакетов, необходимых для сборки и запуска приложения
RUN apt-get update \
    && apt-get -y install apt-utils nano wget dialog vim \
    && apt-get -y install --fix-missing \
    build-essential \
    git \
    curl \
    libcurl4 \
    libcurl4-openssl-dev \
    zlib1g-dev \
    libzip-dev \
    zip \
    libbz2-dev \
    locales \
    libmcrypt-dev \
    libicu-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev

# Установка и настройка расширений PostgreSQL
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql --with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql
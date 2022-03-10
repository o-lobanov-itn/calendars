FROM php:8.1-fpm

ARG GIT_USER_EMAIL
ARG GIT_USER_NAME

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev libpq-dev zip \
    && docker-php-ext-install intl opcache pdo pdo_pgsql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

WORKDIR /var/www/calendars

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

RUN curl -OL https://github.com/fabpot/local-php-security-checker/releases/download/v1.2.0/local-php-security-checker_1.2.0_linux_amd64
RUN chmod +x local-php-security-checker_1.2.0_linux_amd64
RUN mv local-php-security-checker_1.2.0_linux_amd64 /usr/local/bin/local-php-security-checker

RUN curl -OL https://phar.phpunit.de/phpcpd.phar
RUN chmod +x phpcpd.phar
RUN mv phpcpd.phar /usr/local/bin/phpcpd

RUN git config --global user.email "$GIT_USER_EMAIL" \
    && git config --global user.name "$GIT_USER_NAME"

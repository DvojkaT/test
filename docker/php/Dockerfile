FROM php:8.2-fpm-alpine
WORKDIR "/test"

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions gd

RUN install-php-extensions pdo pdo_mysql exif gettext intl pdo_pgsql
RUN install-php-extensions xsl shmop sockets sysvmsg sysvsem sysvshm
RUN install-php-extensions opcache zip
RUN install-php-extensions dom xml xmlwriter fileinfo tokenizer

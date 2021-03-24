FROM php:8.0.2-fpm-alpine3.13

RUN apk add --no-cache shadow openssl bash mysql-client git

RUN docker-php-ext-install pdo pdo_mysql

RUN touch /home/www-data/.bashrc | echo "PS1='\w\$ '" >> /home/www-data/.bashrc

ENV DOCKERIZE_VERSION v0.6.1

RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN mkdir -p var/log var/cache && chown -R www-data:www-data /var/www/ var/log var/cache && \
    chmod -R a+rw var/log var/cache

RUN usermod -u 1000 www-data

COPY --chown=www-data:www-data ./composer.json ./composer.lock ./symfony.lock /var/www/

WORKDIR /var/www

RUN rm -rf /var/www/html && ln -s public html

USER www-data

EXPOSE 9000

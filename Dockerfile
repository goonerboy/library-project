
FROM php:7.4-apache


RUN docker-php-ext-install mysqli


RUN echo "memory_limit = 256M" >> /usr/local/etc/php/conf.d/memory-limit.ini


COPY . /var/www/html/


EXPOSE 80


CMD ["apache2-foreground"]

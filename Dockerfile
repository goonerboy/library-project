# Базовый образ для PHP с Apache
FROM php:7.4-apache

# Установка необходимых расширений
RUN docker-php-ext-install mysqli

# Увеличиваем лимит памяти для PHP
RUN echo "memory_limit = 256M" >> /usr/local/etc/php/conf.d/memory-limit.ini

# Копируем файлы приложения в контейнер
COPY . /var/www/html/

# Открываем порт 80
EXPOSE 80

# Запуск Apache
CMD ["apache2-foreground"]

FROM php:8.0-fpm

WORKDIR /var/www/html

COPY . .

RUN apt-get update && apt-get install -y \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath opcache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-interaction --no-scripts --no-progress

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

RUN php artisan migrate --force

RUN php artisan queue:work --tries=3 --timeout=90

CMD php artisan serve --host=0.0.0.0 --port=8000

#!/bin/sh
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
composer install
php artisan key:generate
php artisan serve --host=0.0.0.0 --port=8081

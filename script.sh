#!/bin/sh

git pull
cd GimmeFund
composer install
php artisan config:cache
php artisan migrate:fresh
php artisan db:seed
php artisan serve
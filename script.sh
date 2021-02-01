#!/bin/sh

git pull
cd GimmeFund
cp .env.example .env
composer install
php artisan key:generate
php artisan config:cache
php artisan migrate
php artisan db:seed
php artisan serve
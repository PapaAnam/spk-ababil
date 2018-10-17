#! /bin/sh

php artisan migrate:rollback --step=3 --force
php artisan migrate --force
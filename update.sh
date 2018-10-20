#! /bin/sh

php artisan migrate:rollback --step=7
php artisan migrate --force
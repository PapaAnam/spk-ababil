#! /bin/sh

php artisan migrate:rollback --step=3
php artisan migrate
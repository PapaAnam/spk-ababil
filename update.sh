#! /bin/sh

composer dump-autoload
php artisan db:seed --class=CreateDefaultUser
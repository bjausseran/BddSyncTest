#!/bin/bash

#cp /var/www/sync-api/.env.example .env
source /etc/apache2/envvars
/usr/sbin/apache2 -V
/etc/init.d/apache2 start


su user
cd /var/www/
composer install
php artisan key:generate
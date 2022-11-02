#!/bin/bash

#cp /var/www/sync-api/.env.example .env
source /etc/apache2/envvars
/usr/sbin/apache2 -V
/etc/init.d/apache2 start


su user
export COMPOSER_HOME="$HOME/.config/composer";
cd /var/www/
composer install
php artisan key:generate

!#/bin/bash
docker-compose up -d --build
composer install
php artisan migrate
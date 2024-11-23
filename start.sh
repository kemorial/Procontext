!#/bin/bash
composer install
docker-compose up -d --build
docker exec -it procontext_mysql mysql -uroot -proot -c "CREATE DATABASE laravel"
docker exec -it procontext_php bash -c "cd /var/www && php artisan migrate"
!#/bin/bash
composer install
cd docker-procontext
docker-compose up -d --build
sleep 8
docker exec -it procontext_mysql mysql -uroot -proot -e "CREATE DATABASE laravel"
docker exec -it procontext_php bash -c "cd /var/www && php artisan migrate"
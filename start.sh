!#/bin/bash
composer install
cd docker-procontext
docker-compose up -d --build
docker exec -it procontext_php bash -c "cd /var/www && php artisan migrate"
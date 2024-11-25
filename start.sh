!#/bin/bash
composer install
cd docker-procontext
docker-compose up -d --build

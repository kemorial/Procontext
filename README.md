# Проект "ТЗ для Procontext"

## Для запуска проекта: 
- ### Через  bash:
    - bash start.sh
    - docker exec -it procontext_php bash -c "php artisan migrate"

- ### Вручную:
    - composer install
    - docker-compose up -d --build
    - docker exec -it procontext_php bash -c "php artisan migrate"

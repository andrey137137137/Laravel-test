# Тестовое задание на Laravel

## Отправка заявок на почту менеджеру и сохранение их в базу данных

Отправка на почту реализована с помощью очередей.

**Для работы проекта у вас должны быть установлены**

- Apache 2.4
- PHP 5.6
- MySQL 5.5

**Как установить проект**

1.  clone this repository
2.  composer update
3.  переименовать .env.example в .env
4.  php artisan key:generate
5.  создать базу данных MySQL
6.  в .env изменить следующие настройки:
    - DB_DATABASE, DB_USERNAME и DB_PASSWORD
    - с префиксом MAIL (я использовал mailtrap.io для тестирования)
7.  php artisan migrate --seed
8.  php artisan queue:work

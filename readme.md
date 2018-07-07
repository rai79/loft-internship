# Форма обратной связи на Laravel

Перед использованием необходимо настроить доступ к БД. 
Для этого переименуйте файл ".env.example" в ".env" найдите следующие строки:

DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret

и добавьте в них настройки своей БД.
Для миграции БД выполните комманду:
php artisan migrate --seed

## Обновления от 07.07.2018

Добавлена авторизация пользователей, настроен редирект исходя из параметров учетной записи. 
Авторизованные пользователи имеют доступ только к блоку добавления заявок, менеджер только к модулю просмотра заявок.
Менеджер добавлен в систему со следующими учетными данными: 
Логин: manager@gmail.com
Пароль: manager
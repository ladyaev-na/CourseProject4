## Установка проекта из репозитория
1. Склонируйте репозиторий
```shell
cd domains
git clone https://github.com/ladyaev-na/samokat.git
```
2. Перейдите в папку с проектом и установите composer-зависимости
```shell
cd samokat
composer install
```
3. Скопируйте файл .env.example в .env
```shell
copy .env.example .env
```
4. Сгенерируйте ключ шифрования
```shell
php artisan key:generate
```
5. Выполнить настройку файла .env
```php
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=file

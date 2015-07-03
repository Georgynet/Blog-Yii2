Yii 2 Blog
===================================

Блог на Yii Framework 2

Для того, что бы развернуть блог необходимо:

1. Склонировать репозиторий.

2. После запустить ```composer``` в консоли:
  ```composer install``` / ```composer update```.

3. Выполнить команду и следую инструкциям настроить окружение dev или prod:
  ```
  php /path/to/yii-application/init
  ```

4. Настроить подключение к БД в конфиге:
  ```
  /common/config/main-local.php
  ```

5. Запустить миграции:
  ```
  php yii migrate
  ```

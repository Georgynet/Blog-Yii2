Yii 2 Blog
===================================

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Georgynet/Blog-Yii2/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Georgynet/Blog-Yii2/?branch=master)
[![Code Climate](https://codeclimate.com/github/Georgynet/Blog-Yii2/badges/gpa.svg)](https://codeclimate.com/github/Georgynet/Blog-Yii2)

Блог на Yii Framework 2

Для того, что бы развернуть блог необходимо:

1. Склонировать репозиторий.

2. Выполнить установку ```composer install``` или обновление зависимостей ```composer update```.

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

Пользователь по-умолчанию:

Логин: **demoadmin**

Пароль: **demoadmin**

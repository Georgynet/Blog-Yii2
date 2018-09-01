Yii 2 Blog
===================================

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Georgynet/Blog-Yii2/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Georgynet/Blog-Yii2/?branch=master)
[![Code Climate](https://codeclimate.com/github/Georgynet/Blog-Yii2/badges/gpa.svg)](https://codeclimate.com/github/Georgynet/Blog-Yii2)

Install Blog on Yii Framework 2

1. Clone repository.

2. Run ```composer install``` or ```composer update```.

3. Configure environment dev or prod:
  ```
  php /path/to/yii-application/init
  ```

4. Configure the database connection in the config:
  ```
  /common/config/main-local.php
  ```

5. Run migration:
  ```
  php yii migrate
  ```

Default user:

Login: **demoadmin**

Password: **demoadmin**

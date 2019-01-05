# Notes PHP

## Overview

1. [Install prerequisites](#install-prerequisites)

    Before installing project make sure the following prerequisites have been met.

2. [Run the application](#run-the-application)

    By this point we’ll have all the project pieces in place.

6. [Use Makefile](#use-makefile) [`Optional`]

    When developing, you can use `Makefile` for doing recurrent operations.

7. [Use Docker Commands](#use-docker-commands)

    When running, you can use docker commands for doing recurrent operations.

___

## Install prerequisites

For now, this project has been mainly created for Unix `(Linux/MacOS)`. Perhaps it could work on Windows.

All requisites should be available for your distribution. The most important are :

* [Git](https://git-scm.com/downloads)
* [Docker](https://docs.docker.com/engine/installation/)
* [Docker Compose](https://docs.docker.com/compose/install/)

Check if `docker-compose` is already installed by entering the following command : 

```sh
which docker-compose
```

Check Docker Compose compatibility :

* [Compose file version 3 reference](https://docs.docker.com/compose/compose-file/)

The following is optional but makes life more enjoyable :

```sh
which make
```

On Ubuntu and Debian these are available in the meta-package build-essential. On other distributions, you may need to install the GNU C++ compiler separately.

```sh
sudo apt install build-essential
```

### Images to use

* [Nginx](https://hub.docker.com/_/nginx/)
* [MySQL](https://hub.docker.com/_/mysql/)
* [PHP-FPM](https://hub.docker.com/r/nanoninja/php-fpm/)
* [Composer](https://hub.docker.com/_/composer/)
* [PHPMyAdmin](https://hub.docker.com/r/phpmyadmin/phpmyadmin/)
* [Generate Certificate](https://hub.docker.com/r/jacoelho/generate-certificate/)

You should be careful when installing third party web servers such as MySQL or Nginx.

This project use the following ports :

| Server     | Port |
|------------|------|
| MySQL      | 8989 |
| PHPMyAdmin | 8080 |
| Nginx      | 8000 |
| Nginx SSL  | 3000 |

___


## Run the application

1. Copying the composer configuration file : 

    ```sh
    cp web/app/composer.json.dist web/app/composer.json
    ```

2. Start the application :

    ```sh
    sudo docker-compose up -d
    ```

    **Please wait this might take a several minutes...**

    ```sh
    sudo docker-compose logs -f # Follow log output
    ```

3. Open your favorite browser :

    * [http://localhost:8000](http://localhost:8000/)
    * [https://localhost:3000](https://localhost:3000/) ([HTTPS](#configure-nginx-with-ssl-certificates) not configured by default)
    * [http://localhost:8080](http://localhost:8080/) PHPMyAdmin (username: dev, password: dev)

4. Stop and clear services

    ```sh
    sudo docker-compose down -v
    ```

___

## Use Makefile

When developing, you can use [Makefile](https://en.wikipedia.org/wiki/Make_(software)) for doing the following operations :

| Name          | Description                                  |
|---------------|----------------------------------------------|
| clean         | Clean directories for reset                  |
| docker-start  | Create and start containers                  |
| docker-stop   | Stop and clear all services                  |
| logs          | Follow log output                            |
| mysql-dump    | Create backup of all databases               |
| mysql-restore | Restore backup of all databases              |

### Examples

Start the application :

```sh
sudo make docker-start
```

Show help :

```sh
make help
```

___

## Use Docker commands

### Installing package with composer

```sh
sudo docker run --rm -v $(pwd)/web/app:/app composer require symfony/yaml
```

### Updating PHP dependencies with composer

```sh
sudo docker run --rm -v $(pwd)/web/app:/app composer update
```

### Generating PHP API documentation

```sh
sudo docker-compose exec -T php php -d memory_limit=256M -d xdebug.profiler_enable=0 ./app/vendor/bin/apigen generate app/src --destination ./app/doc
```

### Testing PHP application with PHPUnit

```sh
sudo docker-compose exec -T php ./app/vendor/bin/phpunit --colors=always --configuration ./app
```

### Fixing standard code with [PSR2](http://www.php-fig.org/psr/psr-2/)

```sh
sudo docker-compose exec -T php ./app/vendor/bin/phpcbf -v --standard=PSR2 ./app/src
```

### Checking the standard code with [PSR2](http://www.php-fig.org/psr/psr-2/)

```sh
sudo docker-compose exec -T php ./app/vendor/bin/phpcs -v --standard=PSR2 ./app/src
```

### Analyzing source code with [PHP Mess Detector](https://phpmd.org/)

```sh
sudo docker-compose exec -T php ./app/vendor/bin/phpmd ./app/src text cleancode,codesize,controversial,design,naming,unusedcode
```

### Checking installed PHP extensions

```sh
sudo docker-compose exec php php -m
```

### Handling database

#### MySQL shell access

```sh
sudo docker exec -it mysql bash
```

and

```sh
mysql -u"$MYSQL_ROOT_USER" -p"$MYSQL_ROOT_PASSWORD"
```

#### Creating a backup of all databases

```sh
mkdir -p data/db/dumps
```

```sh
source .env && sudo docker exec $(sudo docker-compose ps -q mysqldb) mysqldump --all-databases -u"$MYSQL_ROOT_USER" -p"$MYSQL_ROOT_PASSWORD" > "data/db/dumps/db.sql"
```

#### Restoring a backup of all databases

```sh
source .env && sudo docker exec -i $(sudo docker-compose ps -q mysqldb) mysql -u"$MYSQL_ROOT_USER" -p"$MYSQL_ROOT_PASSWORD" < "data/db/dumps/db.sql"
```

#### Creating a backup of single database

**`Notice:`** Replace "YOUR_DB_NAME" by your custom name.

```sh
source .env && sudo docker exec $(sudo docker-compose ps -q mysqldb) mysqldump -u"$MYSQL_ROOT_USER" -p"$MYSQL_ROOT_PASSWORD" --databases YOUR_DB_NAME > "data/db/dumps/YOUR_DB_NAME_dump.sql"
```

#### Restoring a backup of single database

```sh
source .env && sudo docker exec -i $(sudo docker-compose ps -q mysqldb) mysql -u"$MYSQL_ROOT_USER" -p"$MYSQL_ROOT_PASSWORD" < "data/db/dumps/YOUR_DB_NAME_dump.sql"
```


#### Connecting MySQL from [PDO](http://php.net/manual/en/book.pdo.php)

```php
<?php
    try {
        $dsn = 'mysql:host=mysql;dbname=test;charset=utf8;port=3306';
        $pdo = new PDO($dsn, 'dev', 'dev');
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
?>
```

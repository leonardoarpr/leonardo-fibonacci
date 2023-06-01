All credits to https://github.com/nanoninja/docker-nginx-php-mysql (@nanoninja) who did an incredible job.
I added a bunch of stuff that I think is really useful when creating a new project on php.


# Nginx PHP

Docker running Nginx, PHP-FPM, Composer.
Added slim 4, php-unit, phinx

## Install prerequisites

Run docker

```sh
make docker-start
```

### Ports

| Server | Port |
|--------|------|
| Nginx  | 8000 |
| Php    | 9000 |

___

2. Start the application :

    ```sh
    sudo docker-compose up -d
    ```

    **Please wait this might take a several minutes...**

    ```sh
    sudo docker-compose logs -f # Follow log output
    ```

3. Open your favorite browser :

    * [http://localhost:8000/hello/nico](http://localhost:8000/hello/nico)
    * [http://localhost:8000/db](http://localhost:8000/db)
    * [https://localhost:3000](https://localhost:3000/) ([HTTPS](#configure-nginx-with-ssl-certificates) not configured by default)

4. Stop and clear services

    ```sh
    sudo docker-compose down -v
    ```

___

## Use Makefile

When developing, you can use [Makefile](https://en.wikipedia.org/wiki/Make_(software)) for doing the following operations :
- Probably outdated command list :( so make sure to check make help toget the latest

| Name           | Description                                  |
|----------------|----------------------------------------------|
| clean          | Clean directories for reset                  |
| code-sniff     | Check the API with PHP Code Sniffer (`PSR2`) |
| composer-up    | Update PHP dependencies with composer        |
| docker-start   | Create and start containers                  |
| docker-stop    | Stop and clear all services                  |
| logs           | Follow log output                            |
| mysql-dump     | Create backup of all databases               |
| mysql-restore  | Restore backup of all databases              |
| test           | Test application with phpunit                |
| run-migrations | Run all migrations                           |
| run-seeds      | Run all seeds                                |

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

## Migrations (updated to use sphinx) http://docs.phinx.org/en/latest/commands.html
```sh
sudo make run-migrations
```

## Use Docker commands

### Installing package with composer

```sh
sudo docker run --rm -v $(pwd)/web/app:/app composer require symfony/yaml
```

### Updating PHP dependencies with composer

```sh
sudo docker run --rm -v $(pwd)/web/app:/app composer update
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

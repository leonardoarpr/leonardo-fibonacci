## Why the code isn't ideal?
code:
```php
function fibonacci($count){
    if($count == 0 || $count == 1){
        return 1;
    } else {
        return fibonacci($count - 1) + fibonacci($count - 2);
    }
}
```
## Because
Each call to Fibonacci function, the PHP will open other tread and use a piece of memory to save it.
After resolve and call function twice time in a loop the function will pass other time resolve it each thread

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
    make docker-start
    ```

    **Please wait this might take a several minutes...**

3. Open your favorite browser :

    * [http://localhost/check](http://localhost:8000/check) the number need be an integer
    * [http://localhost/fibonacci/{number}](http://localhost:8000/fibonacci/100) the number need be an integer

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
| composer-up    | Update PHP dependencies with composer        |
| docker-start   | Create and start containers                  |
| docker-stop    | Stop and clear all services                  |
| logs           | Follow log output                            |
| test           | Test application with phpunit                |

### Examples

Start the application :

```sh
sudo make docker-start
```

Show help :

```sh
make help
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
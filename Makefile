# Makefile for Docker Nginx PHP Composer MySQL

include .env

composer-up:
	@docker run --rm -v $(shell pwd)/web/app:/app composer update

create-seed:
	@docker-compose exec -T php ./app/vendor/bin/phinx seed:create ${NAME}
	@make resetOwner

docker-start:
	docker-compose up -d

docker-stop:
	@docker-compose down -v
	@make clean

logs:
	@docker-compose logs -f

test:
	@docker-compose exec -T php ./app/vendor/bin/phpunit --colors=always --configuration ./app/
	@make resetOwner
docker_exec_php:= docker-compose exec php-fpm
docker_exec_node:= docker-compose exec node

symfony := @$(docker_exec_php) php bin/console
composer := @$(docker_exec_php) php composer.phar
npm := @${docker_exec_node} npm

start:
	docker-compose up -d

stop:
	docker-compose down

restart: stop start

env:
	cp .env.example .env

chmod:
	chmod 777 -R .

setup: env start good

good: composer-install cache-clear migrate seed npm-install npm-dev

composer-install:
	@$(composer) install

migration-make:
	@$(symfony) make:migration

migration-migrate:
	@$(symfony) doctrine:migrations:migrate

migrate: migration-make migration-migrate

seed:
	@$(symfony) doctrine:fixtures:load --append

cache-clear:
	@$(symfony) cache:clear

npm-install:
	@$(npm) install

npm-update:
	@$(npm) update

npm-dev:
	@$(npm) run dev

npm-watch:
	@$(npm) run watch

npm-prod:
	@$(npm) run build

npm-cs-check:
	@$(npm) run code-style-check

npm-cs-fix:
	@$(npm) run code-style-fix

phpcs:
	@$(docker_exec_php) vendor/bin/phpcs ./src

phpcbf:
	@$(docker_exec_php) vendor/bin/phpcbf ./src
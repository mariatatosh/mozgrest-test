SAIL=./vendor/bin/sail

init: install-sail up npm-install generate-keys migrate npm-dev
start: up npm-dev

up:
	$(SAIL) up -d

stop:
	$(SAIL) stop

migrate:
	$(SAIL) artisan migrate

npm-dev:
	$(SAIL) npm run dev

npm-install:
	$(SAIL) npm install

lint:
	$(SAIL) php ./vendor/bin/pint --test

lint-fix:
	$(SAIL) php ./vendor/bin/pint

install-sail:
	docker run --rm -u $$(id -u):$$(id -g) -v $$(pwd):/var/www/html -w /var/www/html laravelsail/php82-composer:latest composer install --ignore-platform-reqs

copy-env:
	cp .env.example .env

generate-keys:
	$(SAIL) artisan key:generate

unit-tests:
	$(SAIL) artisan test --testsuite=Unit

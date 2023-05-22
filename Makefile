SAIL=./vendor/bin/sail

init: install-sail generate-keys install-dependencies migrate start
start: up npm-dev

up:
	$(SAIL) up -d

stop:
	$(SAIL) stop

migrate:
	$(SAIL) artisan migrate

npm-dev:
	$(SAIL) npm run dev

lint:
	$(SAIL) php ./vendor/bin/pint --test

lint-fix:
	$(SAIL) php ./vendor/bin/pint

install-sail:
	docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd):/var/www/html" \
        -w /var/www/html \
        laravelsail/php82-composer:latest \
        composer install --ignore-platform-reqs

install-dependencies:
	$(SAIL) composer install
	$(SAIL) npm install

copy-env:
	cp .env.example .env

generate-keys:
	$(SAIL) artisan key:generate

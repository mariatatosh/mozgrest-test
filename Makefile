SAIL=./vendor/bin/sail

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

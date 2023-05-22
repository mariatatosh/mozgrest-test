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

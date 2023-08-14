PHP = /usr/local/opt/php@8.2/bin/php
COMPOSER = /usr/local/opt/composer/bin/composer

ready:
	make test
	make phpstan

fresh:
	$(PHP) artisan migrate:fresh
	$(PHP) artisan db:seed

phpstan:
	$(PHP) vendor/bin/phpstan analyse

up:
	$(COMPOSER) up

install:
	$(COMPOSER) install

test:
	$(PHP) vendor/bin/paratest --processes=6

octane-start:
	$(PHP) artisan octane:start --watch

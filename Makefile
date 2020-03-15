# Container mgmt
reset-containers:
	@docker-compose down
	@docker volume rm -f zorglijn_dev-certs
	@docker-compose up -d

# Admin
admin-restart:
	@docker-compose restart admin

admin-install:
	@docker-compose exec admin yarn install

# PHP
shell:
	@docker-compose exec php /bin/bash

fixtures:
	@docker-compose exec php bin/console h:f:l

clean-assets:
	@docker-compose exec php sh -c 'rm -rf public/assets/*'

clear-cache:
	@docker-compose exec php bin/console cache:clear

update-schema:
	@docker-compose exec php bin/console doctrine:schema:update --force

drop-schema:
	@docker-compose exec php bin/console doctrine:schema:drop --force

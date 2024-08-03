include /$(PWD)/.env
# sail := ./vendor/bin/sail
docker-compose := docker compose
docker-container := docker container
docker-container-exec := $(docker-container) exec -it
artisan := $(docker-container-exec) --user root ${CONTAINER_PHP_NAME} php artisan
php := $(docker-container-exec) --user root ${CONTAINER_PHP_NAME}

artisan-cmd:
	@$(artisan)
controller:
	@$(artisan) make:controller
factory:
	@$(artisan) make:factory
request:
	@$(artisan) make:request
resource:
	@$(artisan) make:resource
rl:
	@$(artisan) route:list
cc: ccfg
	@$(artisan) cache:clear
ccfg:
	$(artisan) config:cache
db-refresh:
	$(artisan) migrate:fresh
db-migrate:
	$(artisan) migrate
rt: ## Run unit tests
	$(php) php ./vendor/bin/pest
test: cl
	@$(artisan) make:test --unit --pest
feature-test:
	@$(artisan) make:test --pest
ssl:
	@sudo apt install -y libnss3-tools mkcert && mkcert -install; \
    mkcert -install; \
    mkcert -cert-file ./docker/nginx/certs/bugloos.etl.com.pem -key-file ./docker/nginx/certs/bugloos.etl.com-key.pem localhost 127.0.0.1 bugloos.etl.com;
up:
	$(docker-compose) up -d
down:
	$(docker-compose) down
sh:
	@$(php) bash
web-server:
	$(docker-container-exec) ${CONTAINER_WEB_SERVER_NAME} bash
db:
	$(docker-container-exec) ${CONTAINER_DB_NAME} mysql -u root --password=${MYSQL_ROOT_PASSWORD}
restart-nginx:
	$(docker-container) restart ${CONTAINER_WEB_SERVER_NAME}
cl: /bin/bash
	clear


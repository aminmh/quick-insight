include /$(PWD)/.env
# sail := ./vendor/bin/sail
docker-compose := docker compose
docker-container := docker container
docker-container-exec := $(docker-container) exec -it
php := $(docker-container-exec) --user root ${CONTAINER_PHP_NAME}

rt: ## Run unit tests
	$(php) php ./vendor/bin/pest
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


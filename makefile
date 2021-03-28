start:
	docker-compose up -d

build:
	docker-compose up -d --build

down:
	docker-compose down

stop:
	docker-compose stop

rm:
	docker-compose rm

swagger-run:
	cli/swagger-run

dump:
	docker exec -it server_app_money bash -c  "composer dump-autoload"

migrate: start
	cli/migrate

migrate-test: start
	cli/migrate-test

setup: build migrate migrate-test

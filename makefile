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

open-doc:
	cli/open-doc

swagger-run:
	cli/swagger-run

dump:
	docker exec -it server_app_money bash -c  "composer dump-autoload"

migrate-diff: start
	 cli/console doctrine:migrations:diff

migrate: start
	cli/migrate

migrate-test: start
	cli/migrate-test

run-all-tests: start migrate-test
	cli/run-all-tests

setup: build migrate migrate-test run-all-tests open-doc

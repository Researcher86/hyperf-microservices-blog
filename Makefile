build:
	docker-compose build

up: php-clear
	docker-compose up -d
	#docker-compose exec hyperf php bin/hyperf.php migrate

restart: down up

logs:
	docker-compose logs

down:
	docker-compose down

down-all:
	docker-compose down -v


client-bash:
	docker-compose exec client sh

posts-bash:
	docker-compose exec posts bash

comments-bash:
	docker-compose exec comments bash

query-bash:
	docker-compose exec query bash

moderation-bash:
	docker-compose exec moderation bash


gen-producer:
	docker-compose exec hyperf php bin/hyperf.php gen:amqp-producer DemoProducer

gen-consumer:
	docker-compose exec hyperf php bin/hyperf.php gen:amqp-consumer DemoConsumer

gen-command:
	docker-compose exec hyperf php bin/hyperf.php gen:command FooCommand

run-command:
	docker-compose exec hyperf php bin/hyperf.php demo:command

user-gen-migration:
	docker-compose exec user-ms php bin/hyperf.php gen:migration create_users_table

user-gen-model:
	docker-compose exec user-ms php bin/hyperf.php gen:model users

migrate:
	docker-compose exec posts php bin/hyperf.php migrate
	docker-compose exec comments php bin/hyperf.php migrate
	docker-compose exec query php bin/hyperf.php migrate
	docker-compose exec moderation php bin/hyperf.php migrate

php-clear:
	rm -rf comments/runtime/container
	rm -rf posts/runtime/container
	rm -rf query/runtime/container
	rm -rf moderation/runtime/container

# make bench
bench:
    # https://github-wiki-see.page/m/giltene/wrk2/wiki/Installing-wrk2-on-Linux#:~:text=Installing%20wrk2%20on,wrk%20and%20build.
	wrk -t10 -c1000 -R5000 http://localhost:9501/api/login


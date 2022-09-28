up:
	docker-compose up -d
install:
	cp .env.example .env
	docker-compose build laravel.test
	make up
	make composer-install
	docker-compose exec laravel.test chmod -R 777 ./storage/
	docker-compose exec laravel.test php artisan key:generate
	docker-compose start mysql
	make migrate
	docker-compose exec laravel.test npm i
	docker-compose exec laravel.test npm run build
	make test
reinstall:
	make stop
	make install
stop:
	docker-compose down
	docker-compose down --volumes
migrate:
	docker-compose exec laravel.test php artisan migrate:fresh --force --seed
seed:
	docker-compose exec laravel.test php artisan db:seed
test:
	docker-compose exec laravel.test php artisan test --stop-on-failure
shell:
	docker-compose exec laravel.test sh
composer-install:
	docker-compose exec laravel.test /bin/bash -c 'composer install'

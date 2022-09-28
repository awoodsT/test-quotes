up:
	docker-compose up -d
install:
	cp .env.example .env
	docker-compose build laravel.test
	make up
	make composer-install
	docker-compose exec laravel.test php artisan key:generate
	docker-compose start mysql
	make migrate
	make test
reinstall:	
	make up
	docker-compose exec laravel.test rm -rf ./vendor
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
	docker-compose exec laravel.test composer install

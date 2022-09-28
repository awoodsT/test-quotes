up:
	docker-compose up -d
install:
	cp .env.example .env
	docker-compose build laravel.test
	make up
	make composer-install
	docker-compose exec laravel.test php artisan key:generate
	make migrate
reinstall:	
	docker-compose exec laravel.test rm -rf ./vendor
	make install
stop:
	docker-compose stop
migrate:
	docker-compose exec laravel.test php artisan migrate:fresh --force --seed
seed:
	docker-compose exec laravel.test php artisan db:seed
test:
	docker-compose exec laravel.test ./vendor/bin/phpunit --stop-on-failure
shell:
	docker-compose exec laravel.test sh
composer-install:
	docker-compose exec laravel.test composer install

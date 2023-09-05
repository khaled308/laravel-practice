start:
	docker-compose up -d

stop:
	docker-compose down

artisan:
	docker-compose run --rm artisan $(filter-out $@,$(MAKECMDGOALS))

composer:
	docker-compose run --rm composer $(filter-out $@,$(MAKECMDGOALS))

npm:
	docker-compose run --rm npm $(filter-out $@,$(MAKECMDGOALS))

migrate:
	docker-compose run --rm artisan migrate
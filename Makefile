.env:
	if [ ! -f .env ]; then cp .env.example .env; fi

update:
	composer install --prefer-dist --no-interaction

initdb:
	rm -rf database/database.sqlite
	touch database/database.sqlite
	php artisan migrate
	php artisan db:seed

init: .env update initdb


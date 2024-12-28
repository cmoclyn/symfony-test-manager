up:
	docker compose up -d --build

install:
	docker compose exec app composer install

bash:
	docker compose exec app bash
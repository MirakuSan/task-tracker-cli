.PHONY: run shell build up down kill

build:
	docker compose build

run:
	docker compose run --rm app

shell:
	docker compose run --rm app sh

up:
	docker compose up -d

down:
	docker compose down

kill:
	docker compose kill

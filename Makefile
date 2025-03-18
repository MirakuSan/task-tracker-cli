.PHONY: build run shell up down test coverage install

build:
	docker compose build

install:
	docker compose run --rm app composer install

run: install
	docker compose run --rm app php app.php

shell:
	docker compose run --rm app bash

up:
	docker compose up -d

down:
	docker compose down

test: install
	docker compose run --rm app composer test

coverage: install
	docker compose run --rm app composer coverage

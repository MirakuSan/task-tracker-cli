.PHONY: help build run shell up down test coverage install

# COLORS
GREEN  := $(shell tput -Txterm setaf 2)
YELLOW := $(shell tput -Txterm setaf 3)
WHITE  := $(shell tput -Txterm setaf 7)
RESET  := $(shell tput -Txterm sgr0)

TARGET_MAX_CHAR_NUM=20

## Show help
help:
	@echo ''
	@echo 'Usage:'
	@echo '  ${YELLOW}make${RESET} ${GREEN}<target>${RESET}'
	@echo ''
	@echo 'Targets:'
	@awk '/^[a-zA-Z\-\_0-9]+:/ { \
		helpMessage = match(lastLine, /^## (.*)/); \
		if (helpMessage) { \
			helpCommand = substr($$1, 0, index($$1, ":")-1); \
			helpMessage = substr(lastLine, RSTART + 3, RLENGTH); \
			printf "  ${YELLOW}%-$(TARGET_MAX_CHAR_NUM)s${RESET} ${GREEN}%s${RESET}\n", helpCommand, helpMessage; \
		} \
	} \
	{ lastLine = $$0 }' $(MAKEFILE_LIST)

## Build Docker image
build:
	docker compose build

## Install PHP dependencies
install:
	docker compose run --rm app composer install

## Run the application
run: install
	docker compose run --rm app php app.php

## Open a shell in the container
shell:
	docker compose run --rm app bash

## Start containers in the background
up:
	docker compose up -d

## Stop and remove containers
down:
	docker compose down

## Run tests
test: install
	docker compose run --rm app php vendor/bin/phpunit

## Generate test coverage report
coverage: install
	docker compose run --rm app composer coverage

.DEFAULT_GOAL := help

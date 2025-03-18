FROM php:8.4-cli-alpine

WORKDIR /usr/src/app

# Install dependencies if needed, e.g., composer
COPY . /usr/src/app

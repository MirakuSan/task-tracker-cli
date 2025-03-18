# PHP CLI Todo App

A simple command-line Todo application built with PHP 8.4, Docker Compose, and Makefile to streamline local development and improve your PHP CLI skills.

## Prerequisites

- Docker (version 24+ recommended)
- Docker Compose (version 2+ recommended)
- GNU Make (optional but recommended)

## Project Structure

```
.
├── Dockerfile
├── Makefile
├── compose.yaml
└── app.php
```

## Getting Started

### Clone the repository

```bash
git clone git@github.com:MirakuSan/task-tracker-cli.git
cd task-tracker-cli
```

### Build the Docker image

Run this command once to build your Docker image:

```bash
make build
```

### Running the Todo app

To execute your PHP CLI application:

```bash
make run
```

### Accessing the Container Shell

If you want to debug or interact directly inside the container:

```bash
make shell
```

### Managing your Docker container

- Start your container in the background:

```bash
make up
```

- Stop your container:

```bash
make down
```

## Customizing your Application

Modify `app.php` to add your Todo application logic. The Dockerfile can also be customized if you need additional extensions or PHP dependencies.

## Contributing

Feel free to fork the repository, submit issues, or create pull requests to suggest improvements!

## License

This project is open-source and available under the [MIT License](LICENSE).

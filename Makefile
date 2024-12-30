# Variables
DOCKER_COMPOSE = docker-compose
PHP_CONTAINER = backend
VUE_CONTAINER = frontend

# Default target
.PHONY: help
help:
	@echo "Available commands:"
	@echo "  make build           - Build all Docker containers"
	@echo "  make up              - Start Docker containers"
	@echo "  make down            - Stop Docker containers"
	@echo "  make restart         - Restart Docker containers"
	@echo "  make bash            - Access the backend app container"
	@echo "  make vue-bash        - Access the frontend app container"
	@echo "  make logs            - View container logs"
	@echo "  make clean           - Clean all containers, networks, and volumes"
	@echo "  make test-backend     - Run Pest tests for the backend"
	@echo "  make test-frontend    - Run Jest/Pest tests for the frontend"
	@echo "  make build-frontend   - Build the frontend app"

# Docker commands
.PHONY: build
build:
	$(DOCKER_COMPOSE) build

.PHONY: up
up:
	$(DOCKER_COMPOSE) up -d

.PHONY: down
down:
	$(DOCKER_COMPOSE) down

.PHONY: restart
restart: down up

.PHONY: logs
logs:
	$(DOCKER_COMPOSE) logs -f

.PHONY: clean
clean:
	$(DOCKER_COMPOSE) down -v --remove-orphans

# Access backend container shell
.PHONY: bash
bash:
	$(DOCKER_COMPOSE) exec $(PHP_CONTAINER) bash

# Access frontend container shell
.PHONY: vue-bash
vue-bash:
	$(DOCKER_COMPOSE) exec $(VUE_CONTAINER) sh

# Run Pest tests for the backend (Laravel)
.PHONY: test-backend
test-backend:
	$(DOCKER_COMPOSE) exec accessibility_scanner_backend vendor/bin/pest

# Run Jest/Pest tests for the frontend (Vue.js)
.PHONY: test-frontend
test-frontend:
	$(DOCKER_COMPOSE) exec accessibility_scanner_frontend npm run test:unit

.PHONY: build-frontend
build-frontend:
	$(DOCKER_COMPOSE) exec accessibility_scanner_frontend npm run build
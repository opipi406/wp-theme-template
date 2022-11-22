install:
	@make build
	@make up
up:
	docker-compose up -d
build:
	docker-compose build
	
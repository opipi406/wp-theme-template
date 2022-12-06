CP = cp
RM = rm
RM_RF = rm -rf
MV = mv
ifeq ($(OS),Windows_NT)
    CP = copy
		RM = del
		RM_RF = rd /s /q
		MV = move
endif

install:
	@make build
	@make up
up:
	docker-compose up -d
build:
	docker-compose build

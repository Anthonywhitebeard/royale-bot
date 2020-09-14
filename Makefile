SHELL := /bin/bash

CONTAINERS := workspace mysql redis

ifeq ($(OS),Windows_NT)
	UOS = WIN
else
	UNAME_S := $(shell uname -s)
	ifeq ($(UNAME_S),Linux)
		UOS = LINUX
	endif
	ifeq ($(UNAME_S),Darwin)
		UOS = OSX
	endif
endif


down: # Stop and destroy containers
	docker-compose down

up: # Start and run containers
	docker-compose up -d --remove-orphans $(CONTAINERS)

w: # Enter workspace
	docker-compose exec workspace bash

shell: w # Alias to workspace

migrate: # Run Laravel migration
	docker-compose exec -u 1000 workspace php artisan migrate --seed

migrate-status: # See Laravel migration status
	docker-compose exec -u 1000 workspace php artisan migrate:status

update-db: # Run Laravel Fresh migration
	docker-compose exec -u 1000 workspace php artisan migrate:fresh --seed

migrate-rollback: # Rollback Laravel migration
	docker-compose exec -u 1000 workspace php artisan migrate:rollback

restart: # Restart containers
	docker-compose restart $(CONTAINERS)

ps: # Run docker process status
	docker-compose ps

ps-all: # Run docker process status for all containers
	docker ps -a --format="table {{.ID}}\t{{.Names}}\t{{.Image}}\t{{.Status}}"

destroy: # Stop and destroy images and volumes
	docker-compose down -v

composer-install: # Run composer install
	docker-compose exec -u 1000 workspace composer install

mem-composer-update: # Run composer update
	docker-compose exec -u 1000 workspace php -dmemory_limit=-1 /usr/local/bin/composer update

install: composer-install # Install Project

update: composer-install migrate # Update Project

annotate-models: # Add annotations for Laravel Models
	docker-compose exec -u 1000 workspace php artisan ide-helper:model

r: # start laravel workers
	docker-compose exec -u 1000 workspace php artisan queue:work

mf: update-db

am: annotate-models

t:
	docker-compose exec -u 1000 workspace php artisan h:t

m: migrate

seed-classes:
	docker-compose exec -u 1000 workspace php artisan seed classes

seed-events:
	docker-compose exec -u 1000 workspace php artisan seed events

test-seed-classes:
	docker-compose exec -u 1000 workspace php artisan seed classes --env=testing

test-seed-events:
	docker-compose exec -u 1000 workspace php artisan seed events --env=testing
seed-bots:
	docker-compose exec -u 1000 workspace php artisan db:seed --class=BotsSeed

seed: mf seed-classes seed-events seed-bots

test-migrate :
	docker-compose exec -u 1000 workspace php artisan migrate:fresh --seed --env=testing

test: test-migrate test-seed-classes test-seed-events

run:
	docker-compose up -d php-worker

start: run

stop: # Stops containers
	docker-compose stop php-worker

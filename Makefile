PHP     = docker compose exec php
CONSOLE = $(PHP) bin/console
NPM     = docker compose run --rm frontend npm

.DEFAULT_GOAL := help
.PHONY: help up down build logs sh cc console composer migration migrate schema-update schema-validate db-reset fixtures test npm

help: ## Parancsok listája
	@grep -E '^[a-zA-Z_-]+:.*?## ' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "  \033[36m%-16s\033[0m %s\n", $$1, $$2}'

## —— Docker ————————————————————————————————
up: ## Konténerek indítása háttérben
	docker compose up -d

down: ## Konténerek leállítása
	docker compose down

build: ## Image-ek újrabuildelése
	docker compose build

logs: ## Logok követése
	docker compose logs -f

sh: ## Shell a php konténerben
	$(PHP) bash

## —— Symfony ———————————————————————————————
cc: ## Cache ürítése
	$(CONSOLE) cache:clear

console: ## Tetszőleges console parancs, pl. make console c="debug:router"
	$(CONSOLE) $(c)

composer: ## Composer parancs, pl. make composer c="require symfony/uid"
	$(PHP) composer $(c)

## —— Adatbázis —————————————————————————————
migration: ## Új migráció generálása az entitásokból
	$(CONSOLE) make:migration

migrate: ## Migrációk lefuttatása
	$(CONSOLE) doctrine:migrations:migrate --no-interaction

schema-update: ## Séma közvetlen frissítése (csak fejlesztéshez!)
	$(CONSOLE) doctrine:schema:update --force

schema-validate: ## Mapping és séma ellenőrzése
	$(CONSOLE) doctrine:schema:validate

db-reset: ## Adatbázis eldobása és újraépítése migrációkból
	$(CONSOLE) doctrine:schema:drop --force --full-database
	$(CONSOLE) doctrine:migrations:migrate --no-interaction

fixtures: ## Tesztadatok betöltése (orm-fixtures kell hozzá)
	$(CONSOLE) doctrine:fixtures:load --no-interaction

## —— Tesztek ———————————————————————————————
test: ## PHPUnit tesztek futtatása
	$(PHP) bin/phpunit

## —— Frontend ——————————————————————————————
npm: ## npm parancs, pl. make npm c="install axios"
	$(NPM) $(c)

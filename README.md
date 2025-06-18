## Installation

1. Clone the repository.
2. Enter docker folder and run `docker-compose up -d` to start the containers.
3. Run `docker-compose exec -it php-fpm composer install` to install dependencies.
4. Run `docker-compose exec -it php-fpm composer run-script post-root-package-install` to initialize ENV for the project.
5. Run `docker-compose exec -it php-fpm composer run-script post-create-project-cmd` to initialize the project.
6. Run `docker-compose exec -it php-fpm php artisan migrate:fresh --seed` to run migrations.

## API Endpoints

#### GET ROUTES
- **GET:** /api/prices?currency=usd

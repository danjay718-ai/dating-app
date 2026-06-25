# Kindred Dating POC

Kindred is a small Laravel dating-style proof of concept with registration, login, user profiles, profile discovery, and basic messaging between users.

## Stack

- Laravel 13
- PHP 8.3
- MySQL 8.4
- Vite and Tailwind CSS
- Plain Docker Compose setup, not Laravel Sail

## Local Setup With Docker

Copy the Docker environment file:

```bash
cp .env.docker.example .env
```

Build and start the containers:

```bash
docker compose up -d --build
```

Install PHP dependencies:

```bash
docker compose exec --user laravel app composer install
```

Generate the app key:

```bash
docker compose exec --user laravel app php artisan key:generate
```

Run the migrations and seed sample profiles:

```bash
docker compose exec --user laravel app php artisan migrate --seed
```

Install and build frontend assets:

```bash
docker compose run --rm node npm install
docker compose run --rm node npm run build
```

Open the app at:

```text
http://localhost:8000
```

## Demo Account

```text
Email: john.doe@example.com
Password: password
```

You can also register a new account from the app.

## Useful Commands

Run the test suite:

```bash
docker compose exec --user laravel app php artisan test
```

Reset the database with seed data:

```bash
docker compose exec --user laravel app php artisan migrate:fresh --seed
```

Follow web server logs:

```bash
docker compose logs -f nginx
```

Stop the containers:

```bash
docker compose down
```

Stop the containers and remove the MySQL volume:

```bash
docker compose down -v
```

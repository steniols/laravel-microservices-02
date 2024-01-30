# Microservice of evaluations

A company evaluations microservice for [Microservice 01](https://github.com/steniols/laravel-microservices-01).

## Requirements

* Docker(v20.10.6)
* Docker Compose(v1.24.0)
* Port 8001 open (you can change it on .env file)
* [Microservice 01](https://github.com/steniols/laravel-microservices-01) running

## Install

Create a `.env` file:

```bash
cp .env.sample .env
```

Docker containers:
```bash
docker-compose up -d
```

Access docker service:
```bash
docker-compose exec micro_02 bash
```

Install composer dependencies:
```bash
composer install
```

Generate key:
```bash
php artisan key:generate
```

Run migrations:
```bash
php artisan migrate
```

## HTTP requests

List all company evaluations using Company ID:
```bash
curl --request GET \
  --url http://localhost:8001/evaluations/COMPANY_ID \
  --header 'accept: application/json'
```

Create a new evaluation:
```bash
curl --request POST \
  --url http://localhost:8001/evaluations/COMPANY_ID \
  --header 'Content-Type: multipart/form-data' \
  --header 'accept: application/json' \
  --form company=COMPANY_ID \
  --form 'comment=THIS A TEST COMMENT' \
  --form stars=4
```


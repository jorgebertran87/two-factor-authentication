# TWO-FACTOR AUTHENTICATION

## Steps

### Up the stack with docker-compose
```
docker-compose up -d
```

### Install vendors
```
docker-compose exec --user=root php composer install
```

### Run Doctrine migtrations

```
docker-compose exec --user=root php php bin/console doctrine:migrations:migrate
```
## Tests

### Run unit tests

```
docker-compose exec --user=root php ./vendor/bin/phpunit tests/Unit
```

### Run functional tests

```
docker-compose exec --user=root php ./vendor/bin/phpunit tests/Functional
```
## CLI (Symfony commands)

##  Retrieve the Versification info

```
docker-compose exec --user=root php php bin/console verification:retrieve '611 11 11 11' (<phoneNumber>)
```

##  Check the verification info

```
docker-compose exec --user=root php php bin/console verification:retrieve '611 11 11 11' (<phoneNumber>)
```

## Access to the web client (a simple Vue app)

```
http://localhost:8081
```
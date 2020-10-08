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
docker-compose exec php php bin/console doctrine:migrations:migrate
```

### Create production environment

```
docker-compose exec --user=root php composer dump-env prod
```

### Change the MASTER_CODE env

Access to the container and change the MASTER_CODE in environment (env.local.php) (it can be alphanumeric with unlimited size)

```
docker exec -it --user=root two-factor-authentication_php_1 sh
```

## Tests

### Run unit tests

```
docker-compose exec php ./vendor/bin/phpunit tests/Unit
```

### Run functional tests

```
docker-compose exec php ./vendor/bin/phpunit tests/Functional
```
## CLI (Symfony commands)

###  Retrieve the Versification info

```
docker-compose exec php php bin/console verification:retrieve '611 11 11 11' (<phoneNumber>)
```

### Check the verification info

```
docker-compose exec php php bin/console verification:check 5f7e56b01c8ff OKQS (<verificationId> <code|masterCode>)
```

## Access to the web client (a simple Vue app)

```
http://localhost:8081
```

## Documentation

```
Open https://editor.swagger.io and paste the swagger.yml content (located in root folder)
```
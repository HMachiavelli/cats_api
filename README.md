# CATS API - Hostgator Backend Code Challenge

Web API to search Cat Breeds by name.

## API Reference
https://app.swaggerhub.com/apis-docs/HMachiavelli/Cats_API/1.0.0

## Aknowledgments

The API was built with PHP 7.4 and Slim Framework.
The following third-party libraries were used:

[Guzzle](https://github.com/guzzle/guzzle)

[Phinx](https://github.com/cakephp/phinx)

[Firebase JWT](https://github.com/firebase/php-jwt)

[Codeception](https://github.com/codeception/codeception)

## Setup
In order to run it locally, a local MySQL database called `cats_api` is needed. After creating it, run the following commands in the root directory:

```
composer update
./vendor/bin/phinx migrate -e development
./vendor/bin/phinx seed:run
```

Seeds are needed to insert the test admin user.

## Running locally
To test it locally, just run PHP built-in server:

```
php -S localhost:8080
```

## Tests
To run unit and API (integration) tests, run the following command in the root directory:

```
./vendor/bin/codecept run
```

**OBS.:** In order to integration tests to pass, the local DB must be created, the local server must be started and the admin user must be inserted. Otherwise, the tests are going to fail.
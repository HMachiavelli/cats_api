<?php

use Slim\Factory\AppFactory;
use App\Middlewares\JwtMiddleware;
use App\Controllers\AuthController;
use App\Controllers\BreedsController;
use App\Controllers\HealthController;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

$app->addBodyParsingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

\App\Middlewares\ErrorMiddleware::handleHttpErrors($errorMiddleware);

$app->post('/login', AuthController::class . ':generate');
$app->get('/breeds', BreedsController::class . ':search')->add(new JwtMiddleware());
$app->get('/health', HealthController::class . ':check');

$app->run();

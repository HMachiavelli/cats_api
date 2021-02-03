<?php

use App\Controllers\AuthController;
use App\Controllers\BreedsController;
use App\Middlewares\JwtMiddleware;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

\App\Middlewares\ErrorMiddleware::handleHttpErrors($errorMiddleware);

$app->post('/auth', AuthController::class . ':generate');
$app->get('/breeds', BreedsController::class . ':search')->add(new JwtMiddleware());

$app->run();

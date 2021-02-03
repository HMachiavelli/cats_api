<?php

namespace App\Middlewares;

use Slim\Exception\HttpMethodNotAllowedException;
use Slim\Exception\HttpNotFoundException;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Psr7\Response;

class ErrorMiddleware
{
  public static function handleHttpErrors(\Slim\Middleware\ErrorMiddleware &$errorMiddleware): void
  {
    $errorMiddleware->setErrorHandler(
      HttpMethodNotAllowedException::class,
      function () {
        $response = new Response();
        return $response->withStatus(405);
      }
    );

    $errorMiddleware->setErrorHandler(
      HttpNotFoundException::class,
      function () {
        $response = new Response();
        return $response->withStatus(404);
      }
    );

    $errorMiddleware->setErrorHandler(
      HttpUnauthorizedException::class,
      function () {
        $response = new Response();
        return $response->withStatus(401);
      }
    );
  }
}

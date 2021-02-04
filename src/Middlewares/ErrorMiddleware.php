<?php

namespace App\Middlewares;

use Slim\Psr7\Response;
use Slim\Middleware\ErrorMiddleware as Middleware;
use Slim\Exception\HttpNotFoundException;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Exception\HttpMethodNotAllowedException;

/**
 * 
 * This middleware handles possible HTTP errors in received requests
 * 
 * @param Middleware $errorMiddleware slim app generates an error middleware so we can customize it
 * 
 * @return void
 */
class ErrorMiddleware
{
  public static function handleHttpErrors(Middleware &$errorMiddleware): void
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

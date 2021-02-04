<?php

namespace App\Controllers;

use App\Services\JwtService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * This controller handle the `auth` endpoint.
 * It receives the request and just returns a fresh JWT in response body.
 * 
 */
class AuthController
{
  public function generate(Request $request, Response $response, array $args)
  {
    $service = new JwtService();
    $jwt = $service->generate();

    $response->getBody()->write($jwt);
    return $response;
  }
}

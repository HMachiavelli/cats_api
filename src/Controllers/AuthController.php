<?php

namespace App\Controllers;

use App\Models\User;
use App\Services\JwtService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpUnauthorizedException;

/**
 * This controller handles the `auth` endpoint.
 * It receives the request and just returns a fresh JWT in response body.
 * 
 */
class AuthController
{
  public function generate(Request $request, Response $response, array $args)
  {
    $body = $request->getParsedBody();
    $user = (new User())->getByUsername($body['username'] ?? '');
    if (!$user) {
      throw new HttpUnauthorizedException($request);
    }

    $valid = password_verify($body['password'] ?? '', $user['password']);
    if (!$valid) {
      throw new HttpUnauthorizedException($request);
    }

    $service = new JwtService();
    $jwt = $service->generate($user['username']);

    $data = ['jwt' => $jwt];

    $response->getBody()->write(json_encode($data));
    return $response
      ->withHeader('Content-Type', 'application/json');
  }
}

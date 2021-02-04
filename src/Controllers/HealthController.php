<?php

namespace App\Controllers;

use App\Models\Db;
use PDOException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * This controller handle the `health` endpoint.
 * It receives the request and returns 200 if all resources are operating. Otherwise, it will return a Bad Request or won't return anything at all.
 * 
 */
class HealthController
{
  public function check(Request $request, Response $response, array $args)
  {
    $db = new Db('users');
    try {
      $db->connect();
    } catch (PDOException $e) {
      $response->getBody()->write(json_encode([
        'type' => 'db',
        'message' => 'Couldn\'t connect to database'
      ]));
      return $response
        ->withStatus(400)
        ->withHeader('Content-Type', 'appliaction/health+json');
    }

    $response->getBody()->write('');
    return $response;
  }
}

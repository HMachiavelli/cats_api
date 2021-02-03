<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BreedsController
{
  public function search(Request $request, Response $response, array $args)
  {
    $data = [];

    $response->getBody()->write(json_encode($data));
    return $response
      ->withHeader('Content-Type', 'application/json');
  }
}

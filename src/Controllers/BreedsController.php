<?php

namespace App\Controllers;

use App\Models\Request as BreedRequest;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BreedsController
{
  public function search(Request $request, Response $response, array $args)
  {
    $params = (array)$request->getQueryParams();

    $cachedRequest = (new BreedRequest())->getByName($params['name'] ?? '');
    if ($cachedRequest) {
      $data = $cachedRequest['response'];
    } else {
      $data = '[]';
      //TODO: make thecatsapi request, cache it and return
    }

    $response->getBody()->write($data);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }
}

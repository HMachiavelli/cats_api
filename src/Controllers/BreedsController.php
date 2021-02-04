<?php

namespace App\Controllers;

use App\Models\Request as BreedRequest;
use App\Services\TheCatApiService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BreedsController
{
  public function search(Request $request, Response $response, array $args)
  {
    $params = (array)$request->getQueryParams();

    $data = $this->getOrSearchInApi($params['name'] ?? '');

    $response->getBody()->write($data);
    return $response
      ->withHeader('Content-Type', 'application/json');
  }

  public function getOrSearchInApi($name)
  {
    $cachedResult = (new BreedRequest())->getByName($name);
    if ($cachedResult) {
      return $cachedResult['response'];
    }

    $service      = new TheCatApiService();
    $breedRequest = $service->breedSearch($name);

    (new BreedRequest($breedRequest))->insert();

    return $breedRequest['response'] ?? '[]';
  }
}

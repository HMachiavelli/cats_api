<?php

namespace App\Controllers;

use App\Models\Request as BreedRequest;
use App\Services\TheCatApiService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * 
 * This controller handles the `breeds` endpoint.
 * It receives the target name on the query string, and verifies if it has a cached result on db.
 * If positive, simply return the cached result. Otherwise, uses TheCatApi to fetch a new result.
 * 
 */
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

  public function getOrSearchInApi(string $name): string
  {
    if (empty($name)) {
      return '[]';
    }

    $cachedResult = (new BreedRequest())->getByName($name);
    if ($cachedResult) {
      return $cachedResult['response'];
    }

    $service      = new TheCatApiService();
    $breedRequest = $service->breedSearch($name);
    if (empty($breedRequest)) {
      return '[]';
    }

    (new BreedRequest($breedRequest))->insert();

    return $breedRequest['response'] ?? '[]';
  }
}

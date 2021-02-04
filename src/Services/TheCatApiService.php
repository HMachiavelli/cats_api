<?php

namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;

class TheCatApiService
{
  private $key = 'f515a8f3-7066-4b04-9b23-71955ed62f38';
  private $baseUrl = 'https://api.thecatapi.com';

  public function breedSearch(string $name): array
  {
    try {
      $client = new \GuzzleHttp\Client(['base_uri' => $this->baseUrl]);

      $res = $client->request('GET', '/v1/breeds/search', [
        'headers' => ['x-api-key', $this->key],
        'query' => ['q' => $name]
      ]);
      $parsed = $res->getBody()->getContents();

      return [
        'name' => $name,
        'response' => $parsed
      ];
    } catch (GuzzleException $e) {
      return [];
    }
  }
}

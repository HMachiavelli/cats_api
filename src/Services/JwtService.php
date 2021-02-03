<?php

namespace App\Services;

use Firebase\JWT\JWT;

class JwtService
{
  private $secret;

  public function __construct()
  {
    $this->secret = sha1('hostgator_cats_api'); //this is for example purposes, never would leave it here (and implement it like this) in a real cenario
  }

  public function generate(): string
  {
    $payload = array(
      "iss" => "localhost",
      "aud" => "localhost",
      "iat" => 1356999524,
      "nbf" => 1357000000,
      "exp" => time() + 3600000,
      "sub" => uniqid()
    );

    $jwt = JWT::encode($payload, $this->secret);

    return $jwt;
  }

  public function check(string $jwt): bool
  {
    JWT::decode($jwt, $this->secret, ['HS256']);

    return true;
  }
}

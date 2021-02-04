<?php

namespace App\Services;

use App\Models\User;
use Firebase\JWT\JWT;

class JwtService
{
  private $secret;

  public function __construct()
  {
    $this->secret = sha1('hostgator_cats_api'); //this is for example purposes, never would leave it here (and implement it like this) in a real cenario
  }

  /**
   * 
   * Generates a fresh JWT to the `auth` endpoint
   * 
   * @return string $jwt the new token
   */
  public function generate(string $username): string
  {
    $payload = array(
      "iss" => "localhost",
      "aud" => "localhost",
      "iat" => time(),
      "exp" => time() + 3600000,
      "sub" => $username
    );

    $jwt = JWT::encode($payload, $this->secret);

    return $jwt;
  }

  /**
   * 
   * @param string $jwt received token to check
   * 
   * @return bool true in case of success, otherwise the `decode` method will throw an Exception.
   */
  public function check(string $jwt): bool
  {
    JWT::decode($jwt, $this->secret, ['HS256']);

    return true;
  }
}

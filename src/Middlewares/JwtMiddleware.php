<?php

namespace App\Middlewares;

use Slim\Psr7\Response;
use App\Services\JwtService;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use Slim\Exception\HttpUnauthorizedException;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class JwtMiddleware
{
  /**
   * @param  ServerRequest  $request PSR-7 request
   * @param  RequestHandler $handler PSR-15 request handler
   *
   * @return Response
   */
  public function __invoke(Request $request, RequestHandler $handler): Response
  {
    try {
      $authorization = $request->getHeaders()['Authorization'] ?? null;
      $token = str_replace('Bearer ', '', $authorization[0] ?? '');

      if (empty($token)) {
        throw new HttpUnauthorizedException($request);
      }

      $service = new JwtService();
      $valid   = $service->check($token);
      if (!$valid) {
        throw new HttpUnauthorizedException($request);
      }

      $response = $handler->handle($request);

      return $response;
    } catch (ExpiredException $e) {
      throw new HttpUnauthorizedException($request);
    } catch (SignatureInvalidException $e) {
      throw new HttpUnauthorizedException($request);
    }
  }
}

<?php

namespace App\Middlewares;

use App\Services\JwtService;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class JwtMiddleware
{
  /**
   * 
   * API authentication middleware to `breeds` endpoint.
   * It checks if JWT generated in `auth` endpoit is valid.
   * 
   * @param  ServerRequest  $request PSR-7 request
   * @param  RequestHandler $handler PSR-15 request handler
   *
   * @throws HttpUnauthorizedException Slim can handle this exceptions with it's error middleware
   * 
   * @return Response
   * 
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
      $service->check($token);

      $response = $handler->handle($request);

      return $response;
    } catch (ExpiredException $e) {
      throw new HttpUnauthorizedException($request);
    } catch (SignatureInvalidException $e) {
      throw new HttpUnauthorizedException($request);
    }
  }
}

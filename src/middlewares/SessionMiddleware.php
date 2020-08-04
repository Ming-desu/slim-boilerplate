<?php
declare(strict_types=1);

namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class SessionMiddleware
{
  /**
   * @var Request
   * @var RequestHandler
   * @return Response
   */
  public function __invoke(Request $request, RequestHandler $handler): Response
  {
    if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
      session_start();
      $request = $request->withAttribute('session', $_SESSION);
    }

    return $handler->handle($request);
  }
}
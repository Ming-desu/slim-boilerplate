<?php
declare(strict_types=1);

use Slim\App;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function(App $app) {
  $app->group('/api', function(Group $group) {
    $group->get('', function(Request $request, Response $response) {
      $response->getBody()->write('Hello from API route');
      return $response;
    });
  });
};
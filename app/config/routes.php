<?php
declare(strict_types=1);

use App\Controllers\WelcomeController;
use Slim\App;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

return function(App $app) {
  $app->options('/{routes:.*}', function(Request $request, Response $response) {
    return $response;
  });

  $app->get('/', function(Request $request, Response $response) {
    $response->getBody()->write('Hello from Main route');
    return $response;
  });

  $app->get('/test', WelcomeController::class . '::index');

  $api = require __DIR__ . '/../routes/api.php';
  $api($app);
};
<?php
declare(strict_types=1);

namespace App\Core\Base;

use App\Core\ActionPayload;
use Exception;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface as Response;

abstract class BaseController
{
  /**
   * @var LoggerInterface
   */
  protected $logger;

  public function __construct(LoggerInterface $logger)
  {
    $this->logger = $logger;
  }

  /**
   * @return array|object
   * @throws Exception
   */
  protected function getFormData()
  {
    $input = json_decode(file_get_contents('php://input'));

    if (json_last_error() !== JSON_ERROR_NONE)
      throw new Exception("Malformed JSON input.", 400);

    return $input;
  }

  /**
   * @param array|object|null $data
   * @return Response
   */
  protected function respondWithData(Response $response, $data = null, int $statusCode = 200): Response
  {
    $payload = new ActionPayload($statusCode, $data);

    return $this->respond($response, $payload);
  }

  /**
   * @param ActionPayload $payload
   * @return Response
   */
  protected function respond(Response $response, ActionPayload $payload): Response
  {
    $json = json_encode($payload, JSON_PRETTY_PRINT);
    $response->getBody()->write($json);

    return $response
      ->withHeader('Content-Type', 'application/json')
      ->withStatus($payload->getStatusCode());
  }
}
<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Base\BaseController;
use App\Repositories\UserRepository;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class WelcomeController extends BaseController
{
  private $userRepository;

  public function __construct(UserRepository $userRepository)
  {
    $this->userRepository = $userRepository;  
  }

  public function index(Request $request, Response $response, $args = []): Response
  {
    return $this->respondWithData($response, $this->userRepository->run());
  }
}
<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Core\Base\BaseRepository;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
  public function test(): string
  {
    if (false)
      throw new \Exception("Error Processing Request");
      
    return $this->connection->expr("select now()")->getOne();
  }

  public function run() 
  {
    $user = new User();
    $user->first_name = "Joshua Ming";
    $user->last_name = "Ricohermoso";
    $user->username = "gattofiga";
    $user->password = "password";
    return $user;
  }
}
<?php
declare(strict_types=1);

namespace App\Core\Base;

use atk4\dsql\Mysql\Connection;

class BaseRepository
{
  protected $connection;

  public function __construct(Connection $connection)
  {
    $this->connection = $connection;
  }
}
<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Base\BaseModel;

class User extends BaseModel
{
  protected $hidden = ['password'];
}
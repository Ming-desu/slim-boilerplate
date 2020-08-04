<?php
declare(strict_types=1);

use App\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use DI\ContainerBuilder;
use function DI\autowire;

return function(ContainerBuilder $builder) {
  $builder->addDefinitions([
    UserRepositoryInterface::class => autowire(UserRepository::class)
  ]);
};
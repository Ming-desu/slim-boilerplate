<?php
declare(strict_types=1);

use atk4\dsql\Mysql\Connection;
use atk4\dsql\Mysql\Query;
use DI\ContainerBuilder;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Monolog\Handler\StreamHandler;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

return function(ContainerBuilder $builder) {
  $builder->addDefinitions([
    LoggerInterface::class => function (ContainerInterface $c) {
      $settings = $c->get('settings');

      $loggerSettings = $settings['logger'];
      $logger = new Logger($loggerSettings['name']);

      $processor = new UidProcessor();
      $logger->pushProcessor($processor);

      $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
      $logger->pushHandler($handler);

      return $logger;
    },
    Connection::class => function (ContainerInterface $c) {
      $db = $c->get('settings')['db'];
      return Connection::connect($db['dsn'], $db['username'], $db['password']);
    }
  ]);
};
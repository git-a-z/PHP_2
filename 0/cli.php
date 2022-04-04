<?php

use GeekBrains\Blog\Repositories\RepositoryFactory;
use GeekBrains\Blog\Commands\CommandFactory;
use GeekBrains\Blog\Commands\Arguments;

// Подключаем файл bootstrap.php и получаем настроенный контейнер
$container = require __DIR__ . '/bootstrap.php';

try {
    $repositoryFactory = $container->get(RepositoryFactory::class);
    $repository = $repositoryFactory->create($argv[1]);
    $commandFactory = $container->get(CommandFactory::class);
    $command = $commandFactory->create($argv[1], $repository);
    $command->handle(Arguments::fromArgv($argv));
} catch (Throwable $th) {
    echo "{$th->getMessage()}\n";
}
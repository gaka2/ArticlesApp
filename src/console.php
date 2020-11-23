<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use ArticlesApp\Application\ApplicationContainer;

$container = new ApplicationContainer($argv);
$app = $container->getCommandLineApplication();
$app->run();
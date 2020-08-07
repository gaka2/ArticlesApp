<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use ArticlesApp\Application\CommandLineApplication;

$app = new CommandLineApplication($argv);
$app->run();
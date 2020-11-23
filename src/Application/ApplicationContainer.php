<?php

declare(strict_types=1);

namespace ArticlesApp\Application;

use ArticlesApp\Application\CommandLineApplication;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * @author Karol Gancarczyk
 */
class ApplicationContainer {

    private $containerBuilder;

    public function __construct(array $arguments) {
        $this->containerBuilder = new ContainerBuilder();
        $loader = new YamlFileLoader($this->containerBuilder, new FileLocator(__DIR__ . '/../../config'));
        $loader->load('services.yaml');
        $this->containerBuilder->setParameter('application.arguments', $arguments);
        $this->containerBuilder->compile();
    }

    public function getCommandLineApplication(): CommandLineApplication {
        return $this->containerBuilder->get(CommandLineApplication::class);
    }
}
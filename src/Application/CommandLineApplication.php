<?php

declare(strict_types=1);

namespace ArticlesApp\Application;

use ArticlesApp\Command\CommandFactory;

/**
 * @author Karol Gancarczyk
 */
class CommandLineApplication {

    private const ERROR_MESSAGE_FOR_USER = 'Unexpected error occurred while running the application';

    private $arguments = [];
    private $commandFactory;

    public function __construct(array $arguments, CommandFactory $commandFactory) {
        $this->arguments = $arguments;
        $this->commandFactory = $commandFactory;
    }

    public function run(): void {
        try {
            if (!array_key_exists(1, $this->arguments)) {
                throw new \InvalidArgumentException('Missing command name');
            }

            $command = $this->commandFactory->createFromName($this->arguments[1]);
            $command->setArguments(array_slice($this->arguments, 2));
            $command->execute();

        } catch (\InvalidArgumentException $e) {
            echo $e->getMessage();
        } catch (\RuntimeException $e) {
            echo self::ERROR_MESSAGE_FOR_USER;
        }
    }
}
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

    public function __construct(array $arguments) {
        $this->arguments = $arguments;
    }

    public function run(): void {
        try {
            if (!array_key_exists(1, $this->arguments)) {
                throw new \InvalidArgumentException('Missing command name');
            }

            $command = CommandFactory::createFromName($this->arguments[1]);
            $command->setArguments(array_slice($this->arguments, 2));
            $command->execute();

        } catch (\InvalidArgumentException $e) {
            echo $e->getMessage();
        } catch (\RuntimeException $e) {
            echo self::ERROR_MESSAGE_FOR_USER;
        }
    }
}
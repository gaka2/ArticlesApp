<?php

declare(strict_types=1);

namespace ArticlesApp\Command;

use ArticlesApp\Command\AbstractCommand;

/**
 * @author Karol Gancarczyk
 */
class CommandFactory {

    private $registeredCommands;

    public function __construct(array $registeredCommands) {
        $this->registeredCommands = $registeredCommands;
    }

    public function createFromName(string $name): AbstractCommand {
        foreach ($this->registeredCommands as $command) {
            if ($command->getName() === $name) {
                return $command;
            }
        }

        throw new \InvalidArgumentException('Command does not exist: ' . $name);
    }
}
<?php

declare(strict_types=1);

namespace ArticlesApp\Command;

use ArticlesApp\Command\AbstractCommand;
use ArticlesApp\Command\SimpleCommand;
use ArticlesApp\Command\ExtendedCommand;

/**
 * @author Karol Gancarczyk
 */
class CommandFactory {

    private const REGISTERED_COMMANDS = [
        SimpleCommand::class,
        ExtendedCommand::class,
    ];

    public static function createFromName(string $name): AbstractCommand {
        foreach (self::REGISTERED_COMMANDS as $commandClass) {
            $command = new $commandClass();
            if ($command->getName() === $name) {
                return $command;
            }
        }

        throw new \InvalidArgumentException('Command does not exist: ' . $name);
    }
}
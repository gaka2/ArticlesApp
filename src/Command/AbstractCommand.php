<?php

declare(strict_types=1);

namespace ArticlesApp\Command;

/**
 * @author Karol Gancarczyk
 */
abstract class AbstractCommand {

    private $name;
    private $arguments = [];
    private $requiredArguments = [];

    public function __construct(string $name, array $requiredArguments) {
        $this->name = $name;
        $this->requiredArguments = $requiredArguments;
    }

    protected function getArguments(): array {
        return $this->arguments;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setArguments(array $arguments): void {
        $this->arguments = $arguments;
        $this->validateArguments();
    }

    private function validateArguments(): void {
        foreach ($this->requiredArguments as $key => $name) {
            if (!array_key_exists($key, $this->arguments)) {
                throw new \InvalidArgumentException('Missing command argument: ' . $name);
            }
        }
    }

    abstract public function execute(): void;
}
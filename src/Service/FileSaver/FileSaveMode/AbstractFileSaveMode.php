<?php

declare(strict_types=1);

namespace ArticlesApp\Service\FileSaver\FileSaveMode;

/**
 * @author Karol Gancarczyk
 */
abstract class AbstractFileSaveMode {

    public const NEW_FILE = 'NEW_FILE';
    public const APPEND_TO_FILE = 'APPEND_TO_FILE';

    abstract public function getName(): string;
}
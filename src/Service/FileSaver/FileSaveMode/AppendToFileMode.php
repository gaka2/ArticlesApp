<?php

declare(strict_types=1);

namespace ArticlesApp\Service\FileSaver\FileSaveMode;

/**
 * @author Karol Gancarczyk
 */
class AppendToFileMode extends AbstractFileSaveMode {
    public function getName(): string {
        return AbstractFileSaveMode::APPEND_TO_FILE;
    }
}
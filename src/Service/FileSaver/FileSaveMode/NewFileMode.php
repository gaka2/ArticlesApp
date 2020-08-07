<?php

declare(strict_types=1);

namespace ArticlesApp\Service\FileSaver\FileSaveMode;

/**
 * @author Karol Gancarczyk
 */
class NewFileMode extends AbstractFileSaveMode {
    public function getName(): string {
        return AbstractFileSaveMode::NEW_FILE;
    }
}
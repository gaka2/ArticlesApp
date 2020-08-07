<?php

declare(strict_types=1);

namespace ArticlesApp\Command;

use ArticlesApp\Service\FileSaver\FileSaveMode\AppendToFileMode;

/**
 * @author Karol Gancarczyk
 */
class ExtendedCommand extends AbstractArticlesCommand {

    private const NAME = 'csv:extended';

    public function __construct() {
        parent::__construct(self::NAME, new AppendToFileMode());
    }
}
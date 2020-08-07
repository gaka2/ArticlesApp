<?php

declare(strict_types=1);

namespace ArticlesApp\Command;

use ArticlesApp\Service\FileSaver\FileSaveMode\NewFileMode;

/**
 * @author Karol Gancarczyk
 */
class SimpleCommand extends AbstractArticlesCommand {

    private const NAME = 'csv:simple';

    public function __construct() {
        parent::__construct(self::NAME, new NewFileMode());
    }
}
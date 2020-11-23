<?php

declare(strict_types=1);

namespace ArticlesApp\Command;

use ArticlesApp\Service\FileSaver\FileSaveMode\NewFileMode;
use ArticlesApp\Service\ArticlesService;

/**
 * @author Karol Gancarczyk
 */
class SimpleCommand extends AbstractArticlesCommand {

    private const NAME = 'csv:simple';

    public function __construct(ArticlesService $articlesService) {
        parent::__construct(self::NAME, new NewFileMode(), $articlesService);
    }
}
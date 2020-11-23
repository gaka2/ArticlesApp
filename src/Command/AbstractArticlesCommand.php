<?php

declare(strict_types=1);

namespace ArticlesApp\Command;

use ArticlesApp\Service\ArticlesService;
use ArticlesApp\Service\FileSaver\FileSaveMode\AbstractFileSaveMode;

/**
 * @author Karol Gancarczyk
 */
abstract class AbstractArticlesCommand extends AbstractCommand {

    private const REQUIRED_ARGUMENTS = ['URL', 'PATH'];

    private $fileSaveMode;
    private $articlesService;

    public function __construct(string $name, AbstractFileSaveMode $fileSaveMode, ArticlesService $articlesService) {
        $this->fileSaveMode = $fileSaveMode;
        $this->articlesService = $articlesService;

        parent::__construct($name, self::REQUIRED_ARGUMENTS);
    }

    public function execute(): void {
        $arguments = $this->getArguments();
        $url = $arguments[0];
        $fileName = $arguments[1];

        $articles = $this->articlesService->getArticles($url);
        $this->articlesService->saveArticlesToFile($fileName, $articles, $this->fileSaveMode);
    }
}
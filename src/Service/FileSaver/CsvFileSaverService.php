<?php

declare(strict_types=1);

namespace ArticlesApp\Service\FileSaver;

use ArticlesApp\Service\FileSaver\FileSaveMode\AbstractFileSaveMode;
use ArticlesApp\Service\FileSaver\FileSaveMode\NewFileMode;
use ArticlesApp\Service\FileSaver\FileSaveMode\AppendToFileMode;
use Symfony\Component\Filesystem\Filesystem;
use ArticlesApp\Serializer\CsvArticleSerializer;

/**
 * @author Karol Gancarczyk
 */
class CsvFileSaverService {

    private $filesystem;

    public function __construct() {
        $this->filesystem = new Filesystem();
    }

    public function saveArticles(string $fileName, array $articles, AbstractFileSaveMode $fileSaveMode): void {

        if ($fileSaveMode instanceof AppendToFileMode) {
            if (!$this->filesystem->exists($fileName)) {
                throw new \InvalidArgumentException("Trying append to file {$fileName} but this file does not exist");
            }
        }

        $fileContent = $this->prepareFileConent($articles, $fileSaveMode);

        $fileSaveModeName = $fileSaveMode->getName();

        switch ($fileSaveModeName) {
            case AbstractFileSaveMode::NEW_FILE:
                $this->filesystem->dumpFile($fileName, $fileContent);
                break;
            case AbstractFileSaveMode::APPEND_TO_FILE:
                $this->filesystem->appendToFile($fileName, $fileContent);
                break;
            default:
                throw new \LogicException('Unsupported FileSaveMode: ' . $fileSaveModeName);
        }
    }

    private const END_LINE = "\n";

    private function prepareFileConent(array $articles, AbstractFileSaveMode $fileSaveMode): string {

        $serializer = new CsvArticleSerializer();

        $result = '';

        if ($fileSaveMode instanceof NewFileMode) {
            $result .= $serializer->getCsvHeader() . self::END_LINE;
        }

        foreach ($articles as $article) {
            $result .= $serializer->serialize($article) . self::END_LINE;
        }

        return $result;
    }
}
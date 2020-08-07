<?php

declare(strict_types=1);

namespace ArticlesApp\Serializer;

use ArticlesApp\Serializer\ArticleSerializerInterface;
use ArticlesApp\Model\Article;

/**
 * @author Karol Gancarczyk
 */
class CsvArticleSerializer implements ArticleSerializerInterface {

    private const COLUMNS = [
        'title',
        'description',
        'link',
        'pubDate',
        'creator',
    ];

    private const DEFAULT_DELIMITER = ',';

    private $delimiter;

    public function __construct(string $delimiter = self::DEFAULT_DELIMITER) {
        $this->delimiter = $delimiter;
    }

    public function serialize(Article $article) {
        $data = $this->getObjectDataArray($article);

        if (count($data) !== count(self::COLUMNS)) {
            throw new \LogicException('Number of object properties does not match number of columns');
        }

        return $this->mapArrayToCsvRow($data);
    }

    public function getCsvHeader(): string {
        return $this->mapArrayToCsvRow(self::COLUMNS);
    }

    private function getObjectDataArray(Article $article): array {
        return [
            $article->getTitle(),
            $article->getDescription(),
            $article->getLink(),
            $article->getPubDate()->format('j F Y H:i:s'),
            $article->getCreator()
        ];
    }

    private function mapArrayToCsvRow(array $data): string {
        $csvRow = array_reduce($data, function ($csvRow, $property) {
            $csvRow .= "\"" .  $this->escapeQuotes($property) . "\"" . $this->delimiter;
            return $csvRow;
        }, '');

        return substr($csvRow, 0, strlen($csvRow) - 1);
    }

    private function escapeQuotes(string $text): string {
        return str_replace("\"", "\"\"", $text);
    }
}
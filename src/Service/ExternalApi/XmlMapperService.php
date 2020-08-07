<?php

declare(strict_types=1);

namespace ArticlesApp\Service\ExternalApi;

use ArticlesApp\Model\Article;

/**
 * @author Karol Gancarczyk
 */
class XmlMapperService {

    public function mapToBusinessDomainObjects(\SimpleXMLElement $xmlDocument): array {

        $articles = [];

        foreach ($xmlDocument->xpath('channel/item') as $node) {
            $articles[] = $this->createArticleFromXmlNode($node);
        }

        return $articles;
    }

    private function createArticleFromXmlNode(\SimpleXMLElement $node): Article {

        $article = new Article();
        $article->setTitle($this->getChildNodeValue($node, 'title'));
        $article->setDescription(strip_tags($this->getChildNodeValue($node, 'description')));
        $article->setLink($this->getChildNodeValue($node, 'link'));
        $pubDate = $this->getChildNodeValue($node, 'pubDate');
        $article->setPubDate(new \DateTime($pubDate));
        $article->setCreator($this->getChildNodeValue($node, 'dc:creator'));

        return $article;
    }

    private function getChildNodeValue(\SimpleXMLElement $node, string $childNodeName): string {
        $result = $node->xpath($childNodeName);
        if ($result === false) {
            throw new \RuntimeException($childNodeName);
        }

        if (!array_key_exists(0, $result)) {
            throw new \RuntimeException($childNodeName);
        }

        return (string) $result[0];
    }

}
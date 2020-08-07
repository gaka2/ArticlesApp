<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use ArticlesApp\Service\ExternalApi\XmlMapperService;
use ArticlesApp\Model\Article;

/**
 * @author Karol Gancarczyk
 */
final class XmlMapperServiceTest extends TestCase {

    protected static $mapper;

    public static function setUpBeforeClass(): void {
        self::$mapper = new XmlMapperService();
    }

    public function testWhenPassedIncorrectXmlShouldThrowException(): void {

        $this->expectException(\RuntimeException::class);

        $xmlStringWithMissingData = <<<XML
<rss>
<channel>
  <item>
    <title>Everyday Italian</title>
    <author>Giada De Laurentiis</author>
  </item>
  <item>
    <title>Harry Potter</title>
    <author>J K. Rowling</author>
  </item>
</channel>
</rss>
XML;

        $xmlDocument = new \SimpleXMLElement($xmlStringWithMissingData);
        self::$mapper->mapToBusinessDomainObjects($xmlDocument);
    }

    public function testWhenPassedCorrectXmlShouldReturnArticle(): void {

        $expectedTitle = 'Announcing the 2020-2021 National Geographic Storytelling Fellows';
        $expectedDescription = 'Today, the National Geographic Society is pleased to announce the selection of the 2020-2021 National Geographic Storytelling Fellows.  Nominated for their dedication and commitment to shining a light on our shared human experience as well as demonstrating the power of science and exploration to change the world, these nine storytellers represent the fields of photography,...';
        $expectedLink = 'https://blog.nationalgeographic.org/2020/07/23/announcing-the-2020-2021-national-geographic-storytelling-fellows/';
        $expectedPubDate = 'Thu, 23 Jul 2020 15:01:44 +0000';
        $expectedCreator = 'Chelsey Perry';

        $xmlStringWithCorrectData = <<<XML
<rss version="2.0"
    xmlns:content="http://purl.org/rss/1.0/modules/content/"
    xmlns:wfw="http://wellformedweb.org/CommentAPI/"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:atom="http://www.w3.org/2005/Atom"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
    >
<channel>
  <item>
    <title>{$expectedTitle}</title>
    <link>{$expectedLink}</link>
                <comments>https://blog.nationalgeographic.org/2020/07/23/announcing-the-2020-2021-national-geographic-storytelling-fellows/#respond</comments>
    <dc:creator><![CDATA[{$expectedCreator}]]></dc:creator>
    <pubDate>{$expectedPubDate}</pubDate>
            <category><![CDATA[Our Explorers]]></category>
    <category><![CDATA[National Geographic Storytelling Fellows]]></category>
    <category><![CDATA[Storytelling Fellows]]></category>
    <guid isPermaLink="false">https://blog.nationalgeographic.org/?p=215797</guid>

                <description><![CDATA[{$expectedDescription}]]></description>
  </item>
</channel>
</rss>
XML;

        $xmlDocument = new \SimpleXMLElement($xmlStringWithCorrectData);
        $objects = self::$mapper->mapToBusinessDomainObjects($xmlDocument);

        $this->assertEquals(1, count($objects));
        $article = $objects[0];

        $expectedArticle = new Article();
        $expectedArticle->setTitle($expectedTitle);
        $expectedArticle->setDescription($expectedDescription);
        $expectedArticle->setLink($expectedLink);
        $expectedArticle->setPubDate(new \DateTime($expectedPubDate));
        $expectedArticle->setCreator($expectedCreator);

        $this->assertEquals($expectedArticle, $article);
    }
}
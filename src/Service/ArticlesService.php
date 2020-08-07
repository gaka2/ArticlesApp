<?php

declare(strict_types=1);

namespace ArticlesApp\Service;

use ArticlesApp\Service\ExternalApi\ExternalApiClientServiceFactory;
use ArticlesApp\Service\ExternalApi\XmlMapperService;
use ArticlesApp\Service\FileSaver\FileSaveMode\AbstractFileSaveMode;
use ArticlesApp\Service\FileSaver\CsvFileSaverService;

/**
 * @author Karol Gancarczyk
 */
class ArticlesService {

    public function getArticles(string $url): array {
        $apiClientService = ExternalApiClientServiceFactory::createForUrl($url);
        $xmlDocument = $apiClientService->getDataFromExternalApi();

        $mapperService = new XmlMapperService();
        return $mapperService->mapToBusinessDomainObjects($xmlDocument);
    }

    public function saveArticlesToFile(string $fileName, array $articles, AbstractFileSaveMode $fileSaveMode): void {
        $fileSaverService = new CsvFileSaverService();
        $fileSaverService->saveArticles($fileName, $articles, $fileSaveMode);
    }
}
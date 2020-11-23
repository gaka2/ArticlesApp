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

    private $externalApiClientServiceFactory;
    private $mapperService;
    private $fileSaverService;

    public function __construct(ExternalApiClientServiceFactory $externalApiClientServiceFactory, XmlMapperService $mapperService, CsvFileSaverService $fileSaverService) {
        $this->externalApiClientServiceFactory = $externalApiClientServiceFactory;
        $this->mapperService = $mapperService;
        $this->fileSaverService = $fileSaverService;
    }

    public function getArticles(string $url): array {
        $apiClientService = $this->externalApiClientServiceFactory->createForUrl($url);
        $xmlDocument = $apiClientService->getDataFromExternalApi();

        return $this->mapperService->mapToBusinessDomainObjects($xmlDocument);
    }

    public function saveArticlesToFile(string $fileName, array $articles, AbstractFileSaveMode $fileSaveMode): void {
        $this->fileSaverService->saveArticles($fileName, $articles, $fileSaveMode);
    }
}
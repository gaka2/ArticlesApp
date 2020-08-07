<?php

declare(strict_types=1);

namespace ArticlesApp\Service\ExternalApi;

use ArticlesApp\Service\ExternalApi\AbstractExternalApiClientService;
use ArticlesApp\Service\ExternalApi\ExternalApiClientService;

/**
 * @author Karol Gancarczyk
 */
class ExternalApiClientServiceFactory {

    private const REGISTERED_SERVICES = [
        ExternalApiClientService::class
    ];

    public static function createForUrl(string $url): AbstractExternalApiClientService {
        foreach (self::REGISTERED_SERVICES as $serviceClass) {
            $service = new $serviceClass();
            if ($service->getApiUrl() === $url) {
                return $service;
            }
        }

        throw new \InvalidArgumentException('Unsupported URL: ' . $url);
    }
}
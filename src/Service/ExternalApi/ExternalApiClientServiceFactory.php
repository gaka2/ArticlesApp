<?php

declare(strict_types=1);

namespace ArticlesApp\Service\ExternalApi;

use ArticlesApp\Service\ExternalApi\AbstractExternalApiClientService;

/**
 * @author Karol Gancarczyk
 */
class ExternalApiClientServiceFactory {

    private $registeredServices;

    public function __construct(iterable $registeredServices) {
        $this->registeredServices = $registeredServices;
    }

    public function createForUrl(string $url): AbstractExternalApiClientService {
        foreach ($this->registeredServices as $service) {
            if ($service->getApiUrl() === $url) {
                return $service;
            }
        }

        throw new \InvalidArgumentException('Unsupported URL: ' . $url);
    }
}
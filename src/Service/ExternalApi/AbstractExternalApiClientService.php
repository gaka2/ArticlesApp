<?php

declare(strict_types=1);

namespace ArticlesApp\Service\ExternalApi;

/**
 * @author Karol Gancarczyk
 */
abstract class AbstractExternalApiClientService {
    abstract public function getApiUrl(): string;
}
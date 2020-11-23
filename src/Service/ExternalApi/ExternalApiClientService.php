<?php

declare(strict_types=1);

namespace ArticlesApp\Service\ExternalApi;

use Psr\Http\Client\ClientInterface;

/**
 * @author Karol Gancarczyk
 */
class ExternalApiClientService extends AbstractExternalApiClientService {

    private const HTTP_RESPONSE_OK = 200;
    private const API_URL = 'https://blog.nationalgeographic.org/rss';

    private $client;

    public function __construct(ClientInterface $client) {
        $this->client = $client;
    }

    public function getDataFromExternalApi(): \SimpleXMLElement {
        $request = $this->client->createRequest('GET', self::API_URL);
        $response = $this->client->sendRequest($request);

        $statusCode = $response->getstatusCode();
        if ($statusCode !== self::HTTP_RESPONSE_OK) {
            throw new \RuntimeException('External API returned wrong status code:' . $statusCode);
        }

        $responseContent = $response->getBody()->getContents();

        return new \SimpleXMLElement($responseContent);
    }

    public function getApiUrl(): string {
        return self::API_URL;
    }

}
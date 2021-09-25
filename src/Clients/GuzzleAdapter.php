<?php

namespace src\Clients;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use src\Clients\HttpClientInterface;
use src\Exceptions\ApiHttpClientException;

class GuzzleAdapter implements HttpClientInterface
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client(['headers' => ['x-api-key' => 'f6cbf48d-2211-437b-a030-9fd8e0428db6']]);
        // $this->client = new Client();
    }

    /**
     * @inheritDoc
     */
    public function get(string $uri): ?array
    {
        try {
            return json_decode($this->client->get($uri)->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            throw new ApiHttpClientException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @inheritDoc
     */
    public function post(string $uri, $data = []): ?array
    {
        throw new \BadMethodCallException('Should not be called');
    }

    /**
     * @inheritDoc
     */
    public function delete(string $uri): ?array
    {
        throw new \BadMethodCallException('Should not be called');
    }
}

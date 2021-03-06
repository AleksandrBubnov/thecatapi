<?php

namespace src\APIs;

// use GuzzleHttp\Client;
// use GuzzleHttp\Exception\GuzzleException;
// use src\Exceptions\ApiException;

use src\Builders\ImagesResultsBuilder;
use src\Clients\HttpClientInterface;

class ImagesApi
{
    private HttpClientInterface $client;

    // Interface
    // Facade
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function search(int $limit = 5, int $page = 0, string $order = "DESC")
    {
        $uri = sprintf( // https://api.thecatapi.com/v1/images/search
            'https://api.thecatapi.com/v1/images/search?limit=%d&page=%d&order=%s',
            $limit,
            $page,
            $order
        );

        // проверка кеша
        // логирование апи клиента
        // return $this->client->get($uri);

        // унификация ответа
        return (new ImagesResultsBuilder($this->client->get($uri)))->build();
    }
}

<?php

namespace src\APIs;

use src\Builders\CategoriesResultsBuilder;
use src\Clients\HttpClientInterface;

class CategoriesApi
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function search(int $limit = 5, int $page = 0)
    {
        $uri = sprintf( // https://api.thecatapi.com/v1/categories
            'https://api.thecatapi.com/v1/categories?limit=%d&page=%d',
            $limit,
            $page
        );

        // return $this->client->get($uri);

        return (new CategoriesResultsBuilder($this->client->get($uri)))->build();
    }
}

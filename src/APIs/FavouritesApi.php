<?php

namespace src\APIs;

use src\Builders\FavouritesResultsBuilder;
use src\Clients\HttpClientInterface;

class FavouritesApi
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function search(int $limit = 5, int $page = 0)
    {
        $uri = sprintf( // https://api.thecatapi.com/v1/favourites
            'https://api.thecatapi.com/v1/favourites?limit=%d&page=%d',
            $limit,
            $page
        );

        // return $this->client->get($uri);

        return (new FavouritesResultsBuilder($this->client->get($uri)))->build();
    }
}

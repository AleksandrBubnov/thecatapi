<?php

namespace src\APIs;

use src\Builders\VotesResultsBuilder;
use src\Clients\HttpClientInterface;

class VotesApi
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function search(int $limit = 5, int $page = 0)
    {
        $uri = sprintf( // https://api.thecatapi.com/v1/votes
            'https://api.thecatapi.com/v1/votes?limit=%d&page=%d',
            $limit,
            $page
        );

        return $this->client->get($uri);

        // return (new VotesResultsBuilder($this->client->get($uri)))->build();
    }
}

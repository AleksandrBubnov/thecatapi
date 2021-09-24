<?php

namespace src\Clients;

use src\Exceptions\ApiException;

interface HttpClientInterface
{
    /**
     * @param string $uri
     * @return array|null
     * @throw ApiHttpClientException
     */
    public function get(string $uri): ?array;

    /**
     * @param string $uri
     * @param array $data
     * @return array|null
     * @throw ApiHttpClientException
     */
    public function post(string $uri, $data = []): ?array;

    /**
     * @param string $uri
     * @return array|null
     * @throw ApiHttpClientException
     */
    public function delete(string $uri): ?array;
}

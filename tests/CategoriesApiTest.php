<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use src\APIs\CategoriesApi;
use src\Exceptions\ApiHttpClientException;
use src\Clients\HttpClientInterface;

class CategoriesApiTest extends TestCase
{

    const CATEGORIES_RESPONSE = <<<'RESPONSE'
    [
        {
            "id": 5,
            "name": "boxes"
        },
        {
            "id": 15,
            "name": "clothes"
        }
    ]
    RESPONSE;

    /**
     * @test
     */
    public function we_can_get_categories()
    {
        $client = $this->createMock(HttpClientInterface::class);

        $client->expects($this->once())->method('get')->willReturn(json_decode(self::CATEGORIES_RESPONSE));

        $api = new CategoriesApi($client);
        $result = $api->search();

        $this->assertIsArray($result);
    }

    /**
     * @test
     */
    public function we_throw_exception()
    {
        $client = $this->createMock(HttpClientInterface::class);
        $client->method('get')->willThrowException(
            $this->createMock(ApiHttpClientException::class)
        );
        $api = new CategoriesApi($client);
        $this->expectException(ApiHttpClientException::class);

        $api->search();
    }
}

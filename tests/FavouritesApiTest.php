<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use src\APIs\FavouritesApi;
use src\Exceptions\ApiHttpClientException;
use src\Clients\HttpClientInterface;
use src\Models\Favourite;

class FavouritesApiTest extends TestCase
{
    const FAVORITES_RESPONSE = <<<'RESPONSE'
    [
        {
            "created_at": "2018-10-27T22:50:59.000Z",
            "id": 1118,
            "image": {
                "id": "MjAxNDc5Nw",
                "url": "https://cdn2.thecatapi.com/images/MjAxNDc5Nw.jpg"
            },
            "image_id": "MjAxNDc5Nw",
            "sub_id": "demo-b42d0b",
            "user_id": "4"
        },
        {
            "created_at": "2018-10-27T22:51:01.000Z",
            "id": 1119,
            "image": {
                "id": "1be",
                "url": "https://cdn2.thecatapi.com/images/1be.jpg"
            },
            "image_id": "1be",
            "sub_id": "demo-b42d0b",
            "user_id": "4"
        }
    ]
    RESPONSE;

    /**
     * @test
     */
    public function we_can_get_categories()
    {
        $client = $this->createMock(HttpClientInterface::class);

        $client->expects($this->once())->method('get')->willReturn(json_decode(self::FAVORITES_RESPONSE, true));

        $api = new FavouritesApi($client);
        $result = $api->search();

        $this->assertIsArray($result);
        $this->assertInstanceOf(Favourite::class, $result[0]);
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
        $api = new FavouritesApi($client);
        $this->expectException(ApiHttpClientException::class);

        $api->search();
    }
}

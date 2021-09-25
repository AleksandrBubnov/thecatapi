<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use src\APIs\ImagesApi;
// use GuzzleHttp\Client;
// use GuzzleHttp\Exception\GuzzleException;
use src\Exceptions\ApiHttpClientException;
use src\Clients\HttpClientInterface;
use src\Models\Image;

class ImagesApiTest extends TestCase
{
    const IMAGES_RESPONSE = <<<'RESPONSE'
    [
        {
            "breeds": [],
            "categories": [
        {
            "id": 7,
            "name": "ties"
        }
        ],
            "height": 720,
            "id": "128",
            "url": "https://cdn2.thecatapi.com/images/128.png",
            "width": 537
        },
        {
            "breeds": [],
            "height": 958,
            "id": "20i",
            "url": "https://cdn2.thecatapi.com/images/20i.jpg",
            "width": 960
        }
    ]
    RESPONSE;

    /**
     * @test
     */
    public function we_can_perfom_search()
    {
        $client = $this->createMock(HttpClientInterface::class);

        $client->expects($this->once())->method('get')->willReturn(json_decode(self::IMAGES_RESPONSE, true));

        $api = new ImagesApi($client);
        $result = $api->search();

        $this->assertIsArray($result);
        $this->assertInstanceOf(Image::class, $result[0]);
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
        $api = new ImagesApi($client);
        $this->expectException(ApiHttpClientException::class);

        $api->search();
    }
}

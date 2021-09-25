<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use src\APIs\VotesApi;
use src\Exceptions\ApiHttpClientException;
use src\Clients\HttpClientInterface;
use src\Models\Vote;

class VotesApiTest extends TestCase
{
    const VOTES_RESPONSE = <<<'RESPONSE'
    [
        {
            "country_code": null,
            "created_at": "2018-10-24T08:36:13.000Z",
            "id": 31098,
            "image_id": "43u",
            "sub_id": null,
            "value": 1
        },
        {
            "country_code": null,
            "created_at": "2018-10-24T08:36:16.000Z",
            "id": 31099,
            "image_id": "4lo",
            "sub_id": null,
            "value": 0
        }
    ]
    RESPONSE;

    /**
     * @test
     */
    public function we_can_get_categories()
    {
        $client = $this->createMock(HttpClientInterface::class);

        $client->expects($this->once())->method('get')->willReturn(json_decode(self::VOTES_RESPONSE, true));

        $api = new VotesApi($client);
        $result = $api->search();

        $this->assertIsArray($result);
        // $this->assertInstanceOf(Vote::class, $result[0]);
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
        $api = new VotesApi($client);
        $this->expectException(ApiHttpClientException::class);

        $api->search();
    }
}

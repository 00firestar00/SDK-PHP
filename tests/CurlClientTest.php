<?php

use OntraportAPI\Ontraport;
use OntraportAPI\Tests\Mock\MockCurlClient;
use PHPUnit\Framework\TestCase;

class CurlClientTest extends TestCase
{
    public function testGetRequestHeaders()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $response = json_encode($client->getHttpClient()->getRequestHeaders());
        $this->assertEquals('{"Api-key":"Api-key: Key5678","Api-Appid":"Api-Appid: 2_AppID_12345678"}', $response);

    }
}

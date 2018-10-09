<?php
/**
 * Tests the uncovered code in Ontraport.php after the
 * rest of the SDK is fully covered.
 */

use OntraportAPI\Ontraport;
use OntraportAPI\Tests\Mock\MockCurlClient;
use PHPUnit\Framework\TestCase;

class OntraportTest extends TestCase
{
    public function testGetLastStatusCode()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $client->getHttpClient()->setLastStatusCode(999);
        $response = $client->getLastStatusCode();
        $this->assertEquals(999, $response);
    }

    public function testSetHttpClientNULL()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $client->setHttpClient();
        $response = json_encode($client->getHttpClient()->getRequestHeaders());
        $this->assertEquals('{"Api-key":"Api-key: Key5678","Api-Appid":"Api-Appid: 2_AppID_12345678"}', $response);
    }
}

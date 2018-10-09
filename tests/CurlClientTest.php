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

    public function testSetAndGetLastStatusCode()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $client->getHttpClient()->setLastStatusCode(200);
        $response = $client->getHttpClient()->getLastStatusCode();
        $this->assertEquals(200, $response);
    }

    /**
     * @expectedException \OntraportAPI\Exceptions\HttpMethodException
     */
    public function testHttpMethodException()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array();
        $response = $client->getHttpClient()->httpRequest($requestParams, "ontraport.com", 'undef', null, null);
    }

    /**
     * @expectedException \OntraportAPI\Exceptions\RequiredParamsException
     */
    public function testRequiredParamsException()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array();
        $requiredParams = array("id");
        $response = $client->getHttpClient()->httpRequest($requestParams, "ontraport.com", 'get', $requiredParams, null);
    }

    /**
     * @expectedException \OntraportAPI\Exceptions\TypeException
     */
    public function testTypeException()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = 'notArray';
        $requiredParams = array("id");
        $response = $client->getHttpClient()->httpRequest($requestParams, "ontraport.com", 'get', $requiredParams, null);
    }



}

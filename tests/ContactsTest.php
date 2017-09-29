<?php

use OntraportAPI\Ontraport;
use OntraportAPI\CurlClient;
use PHPUnit\Framework\TestCase;

class ContactsTest extends TestCase
{

    public function testRetrieveSingle()
    {
        // Create a stub for the SomeClass class.
        $stub = $this->createMock(CurlClient::class);

        // Configure the stub.
        $stub->method('httpRequest')
             ->willReturn('{"code":0, "data":{"id":"1", "firstname": "unit", "lastname": "test"}}');


        $client = new Ontraport("2_AppID_12345678","Key5678", $stub);
        $requestParams = array(
            "id" => 27
        );

        $response = $client->contact()->retrieveSingle($requestParams);
        $this->assertEquals(
            '{"code":0, "data":{"id":"1", "firstname": "unit", "lastname": "test"}}', $response);
    }
}

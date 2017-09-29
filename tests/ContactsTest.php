<?php

use OntraportAPI\Ontraport;
use OntraportAPI\CurlClient;
use PHPUnit\Framework\TestCase;

class ContactsTest extends TestCase
{

    public function testRetrieveSingle()
    {

        if (version_compare(PHP_VERSION, '5.5.0', '<'))
        {
            $stub = $this->getMockBuilder('CurlClient')
                         ->setMethods(array('httpRequest'))
                         ->getMock();
            $stub->method('httpRequest')
                     ->willReturn(
                         '{"code":0, "data":{"id":"1", "firstname": "unit", "lastname": "test"}}'
                     );
        }
        else
        {
            $stub = $this->createMock(CurlClient::class);
            $stub->method('httpRequest')
                 ->willReturn(
                     '{"code":0, "data":{"id":"1", "firstname": "unit", "lastname": "test"}}'
                 );
        }

        $client = new Ontraport("2_AppID_12345678","Key5678", $stub);
        $requestParams = array(
            "id" => 27
        );

        $response = $client->contact()->retrieveSingle($requestParams);
        $this->assertEquals(
            '{"code":0, "data":{"id":"1", "firstname": "unit", "lastname": "test"}}', $response);
    }
}

<?php

use OntraportAPI\Ontraport;
use OntraportAPI\Tests\Mock\MockCurlClient;
use PHPUnit\Framework\TestCase;

class WebhooksTest extends TestCase
{

    function testRetrieveSingle()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "id" => 1
        );
        $response = $client->webhook()->retrieveSingle($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "url": "google.com",
    "event": "object_create(0)",
    "id": 1,
    "owner": "1"
  },
  "account_id": 187157
}', $response);
    }

    function testRetrieveMultiple()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array();
        $response = $client->webhook()->retrieveMultiple($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": [
    {
      "id": "1",
      "event": "object_create(0)",
      "data": "",
      "url": "google.com",
      "last_hook": null,
      "last_code": "0",
      "last_payload": ""
    },
    {
      "id": "2",
      "event": "object_create(0)",
      "data": "",
      "url": "yahoo.com",
      "last_hook": null,
      "last_code": "0",
      "last_payload": ""
    }
  ],
  "account_id": 187157,
  "misc": []
}', $response);
    }

    function testRetrieveMultiplePaginated()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "start" => 0,
            "range" => 50,
        );

        $response = $client->webhook()->retrieveMultiplePaginated($requestParams);
        $object_data = array();
        $object_data[] = json_decode('{
  "code": 0,
  "data": [
    {
      "id": "1",
      "event": "object_create(0)",
      "data": "",
      "url": "google.com",
      "last_hook": null,
      "last_code": "0",
      "last_payload": ""
    },
    {
      "id": "2",
      "event": "object_create(0)",
      "data": "",
      "url": "yahoo.com",
      "last_hook": null,
      "last_code": "0",
      "last_payload": ""
    }
  ],
  "account_id": 187157,
  "misc": []
}');

        $this->assertEquals(json_encode($object_data), $response);
    }


    function testSubscribe(){
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "url" => 'test.com',
            "event" => "object_create(0)"
        );
        $response = $client->webhook()->subscribe($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "url": "yahoo.com",
    "event": "object_create(0)",
    "id": 2,
    "owner": "1"
  },
  "account_id": 187157
}', $response);
    }

    function testUnsubscribe(){
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "id" => 0
        );
        $response = $client->webhook()->unsubscribe($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": "Deleted",
  "account_id": 187157
}', $response);
    }


}

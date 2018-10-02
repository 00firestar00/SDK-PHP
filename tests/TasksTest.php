<?php

use OntraportAPI\Ontraport;
use OntraportAPI\Tests\Mock\MockCurlClient;
use PHPUnit\Framework\TestCase;

class TasksTest extends TestCase
{


    function testAssign()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(json_decode('{
  "object_type_id": 0,
  "ids": [
    3
  ],
  "message": {
    "id": 5,
    "due_date": 4
  }
}'));
        $response = $client->task()->assign($requestParams);
        $this->assertEquals('{
  "code": 0,
  "account_id": 187157
}', $response);
    }

    function testReschedule()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(json_decode('{
  "id": 5,
  "newtime": 4
}'));
        $response = $client->task()->assign($requestParams);
        $this->assertEquals('{
  "code": 0,
  "account_id": 187157
}', $response);
    }

    function testCancel()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(json_decode('{
  "objectID": 0,
  "ids": [
    3
  ]
}'));
        $response = $client->task()->cancel($requestParams);
        $this->assertEquals('{
  "code": 0,
  "account_id": 187157
}', $response);
    }

    function testComplete()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(json_decode('{
  "object_type_id": 0,
  "ids": [
    3
  ]
}'));
        $response = $client->task()->complete($requestParams);
        $this->assertEquals('{
  "code": 0,
  "account_id": 187157
}', $response);
    }
}

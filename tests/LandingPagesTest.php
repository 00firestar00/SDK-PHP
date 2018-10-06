<?php

use OntraportAPI\Ontraport;
use OntraportAPI\Tests\Mock\MockCurlClient;
use PHPUnit\Framework\TestCase;

class LandingPagesTest extends TestCase
{


    function testRetrieveSingle()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "id" => 5
        );
        $response = $client->landingpage()->retrieveSingle($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": [
    {
      "domain": "mystore.pages.ontraport.net",
      "date": 1538602369,
      "dlm": "1537912720"
    }
  ],
  "account_id": 187157,
  "misc": []
}', $response);
    }

    function testRetrieveMultiple()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array();
        $response = $client->landingpage()->retrieveMultiple($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": [
    {
      "domain": "mystore.pages.ontraport.net",
      "date": 1538602369,
      "dlm": "1537912720"
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

        $response = $client->landingpage()->retrieveMultiplePaginated($requestParams);
        $object_data = array();
        $object_data[] = json_decode('{
  "code": 0,
  "data": [
    {
      "domain": "mystore.pages.ontraport.net",
      "date": 1538602369,
      "dlm": "1537912720"
    }
  ],
  "account_id": 187157,
  "misc": []
}');

        $this->assertEquals(json_encode($object_data), $response);
    }

    function testRetrieveMeta()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array();
        $response = $client->landingpage()->retrieveMeta($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "20": {
      "name": "LandingPage",
      "fields": {
        "name": {
          "alias": "Name",
          "type": "text",
          "required": "0",
          "unique": "0",
          "editable": "1",
          "deletable": "0"
        },
        "domain": {
          "alias": "Domain",
          "type": "url",
          "required": "0",
          "unique": "0",
          "editable": null,
          "deletable": "1"
        }
      }
    }
  },
  "account_id": 187157
}', $response);
    }

    function testRetrieveCollectionInfo(){
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array();
        $response = $client->landingpage()->retrieveCollectionInfo($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "listFields": [
      "name",
      "domain",
      "lpsent",
      "unique_lpsent",
      "lpconvert",
      "unique_lpconvert",
      "date",
      "dlm"
    ],
    "listFieldSettings": [],
    "cardViewSettings": [],
    "viewMode": [],
    "count": "1"
  },
  "account_id": 187157
}', $response);
    }

    function testGetHostedURL(){
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array();
        $response = $client->landingpage()->getHostedURL($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": "http://user.ontraport.com/123",
  "account_id": 187157
}', $response);
    }
}

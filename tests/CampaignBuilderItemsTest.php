<?php

use OntraportAPI\Ontraport;
use OntraportAPI\Tests\Mock\MockCurlClient;
use PHPUnit\Framework\TestCase;

class CampaignBuilderItemsTest extends TestCase
{

    function testRetrieveSingle()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "id" => 1
        );
        $response = $client->campaignbuilder()->retrieveSingle($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "id": "1",
    "name": "Example: High Level Customer Lifecycle",
    "date": "1538503425",
    "dlm": "1538503670",
    "object_type_id": "0",
    "pause": "0",
    "deleted": "false"
  },
  "account_id": 187157
}', $response);
    }

    function testRetrieveMultiple()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array();
        $response = $client->campaignbuilder()->retrieveMultiple($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": [
    {
      "id": "1",
      "name": "Example: High Level Customer Lifecycle"
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

        $response = $client->campaignbuilder()->retrieveMultiplePaginated($requestParams);
        $object_data = array();
        $object_data[] = json_decode('{
  "code": 0,
  "data": [
    {
      "id": "1",
      "name": "Example: High Level Customer Lifecycle"
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
        $response = $client->campaignbuilder()->retrieveMeta($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "140": {
      "name": "CampaignBuilder",
      "fields": {
        "name": {
          "alias": "Name",
          "type": "text",
          "required": "0",
          "unique": "1",
          "editable": 1,
          "deletable": "0"
        }
      }
    }
  },
  "account_id": 187157
}', $response);
    }

    function testRetrieveCollectionInfo()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array();
        $response = $client->campaignbuilder()->retrieveCollectionInfo($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "listFields": [
      "name",
      "state",
      "date",
      "dlm",
      "subs",
      "subs_ever",
      "element_num",
      "todos"
    ],
    "listFieldSettings": [],
    "cardViewSettings": [],
    "viewMode": [],
    "count": "1"
  },
  "account_id": 187157
}', $response);
    }
}

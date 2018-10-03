<?php

use OntraportAPI\Ontraport;
use OntraportAPI\Tests\Mock\MockCurlClient;
use PHPUnit\Framework\TestCase;

class RulesTest extends TestCase
{

    function testRetrieveSingle()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "id" => 1
        );
        $response = $client->rule()->retrieveSingle($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "id": "1",
    "drip_id": null,
    "events": "",
    "conditions": "",
    "actions": "",
    "name": "rule_name_here",
    "pause": "0",
    "last_action": "0",
    "object_type_id": "0",
    "date": "1538502649",
    "dlm": "1538502649"
  },
  "account_id": 187157
}', $response);
    }

    function testRetrieveMultiple()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array();
        $response = $client->rule()->retrieveMultiple($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": [
    {
      "id": "1",
      "drip_id": null,
      "events": "",
      "conditions": "",
      "actions": "",
      "name": "rule_name_here",
      "pause": "0",
      "last_action": "0",
      "object_type_id": "0",
      "date": "1538502649",
      "dlm": "1538502649"
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

        $response = $client->rule()->retrieveMultiplePaginated($requestParams);
        $object_data = array();
        $object_data[] = json_decode('{
  "code": 0,
  "data": [
    {
      "id": "1",
      "drip_id": null,
      "events": "",
      "conditions": "",
      "actions": "",
      "name": "rule_name_here",
      "pause": "0",
      "last_action": "0",
      "object_type_id": "0",
      "date": "1538502649",
      "dlm": "1538502649"
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
        $response = $client->rule()->retrieveMeta($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "6": {
      "name": "Rule",
      "fields": {
        "pause": {
          "alias": "Status",
          "type": "drop",
          "required": "0",
          "unique": "0",
          "editable": "1",
          "deletable": "0",
          "options": {
            "0": "Live",
            "1": "Paused"
          }
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
        $response = $client->rule()->retrieveCollectionInfo($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "listFields": [
      "name",
      "last_action",
      "pause",
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

    function testCreate(){
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "tags" => "rule_tags",
            "name" => "rule_name"
        );
        $response = $client->rule()->create($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "pause": "0",
    "tags": "rule_tags",
    "name": "rule_name",
    "id": "2",
    "drip_id": null,
    "events": "",
    "conditions": "",
    "actions": "",
    "last_action": "0",
    "object_type_id": "0",
    "date": "1538609658",
    "dlm": "1538609658"
  },
  "account_id": 187157
}', $response);
    }

    function testUpdate(){
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "id" => 2,
            "pause" => 1
        );
        $response = $client->rule()->update($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "attrs": {
      "pause": "1",
      "dlm": "1538609797",
      "id": "2"
    }
  },
  "account_id": 187157
}', $response);
    }

}

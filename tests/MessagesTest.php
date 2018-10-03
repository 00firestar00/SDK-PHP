<?php

use OntraportAPI\Ontraport;
use OntraportAPI\Tests\Mock\MockCurlClient;
use PHPUnit\Framework\TestCase;

class Messages extends TestCase
{

    function testRetrieveSingle()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "id" => 5
            );
        $response = $client->message()->retrieveSingle($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "id": "5",
    "alias": "task_title",
    "tags": "",
  },
  "account_id": 187157
}', $response);
    }

    function testRetrieveMultiple()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array();
        $response = $client->message()->retrieveMultiple($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": [
    {
      "id": "1",
      "alias": "test1",
      "type": "Template",
      "last_save": "1537912999"
    },
    {
      "id": "2",
      "alias": "Abandoned Cart: Did we lose you?",
      "type": "Template",
      "last_save": "1496332432"
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

        $response = $client->message()->retrieveMultiplePaginated($requestParams);
        $object_data = array();
        $object_data[] = json_decode('{
  "code": 0,
  "data": [
    {
      "id": "1",
      "alias": "test1",
      "type": "Template",
      "last_save": "1537912999"
    },
    {
      "id": "2",
      "alias": "Abandoned Cart: Did we lose you?",
      "type": "Template",
      "last_save": "1496332432"
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
        $response = $client->message()->retrieveMeta($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "7": {
      "name": "Message",
      "fields": {
        "alias": {
          "alias": "Name",
          "type": "text",
          "required": "0",
          "unique": "0",
          "editable": "1",
          "deletable": "0"
        },
        "name": {
          "alias": "Name",
          "type": "mergefield",
          "required": "0",
          "unique": "0",
          "editable": 0,
          "deletable": "1"
        },
        "subject": {
          "alias": "Subject",
          "type": "text",
          "required": "0",
          "unique": "0",
          "editable": 1,
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
        $response = $client->message()->retrieveCollectionInfo($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "listFields": [
      "name",
      "subject",
      "spam_score",
      "date",
      "type",
      "mcsent",
      "mcopened",
      "mcclicked",
      "mcnotopened",
      "mcnotclicked",
      "mcunsub",
      "mcabuse",
      "dlm"
    ],
    "listFieldSettings": [],
    "cardViewSettings": [],
    "viewMode": [],
    "count": "5"
  },
  "account_id": 187157
}', $response);
    }

    function testCreate(){
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "type" => "e-mail"
        );
        $response = $client->message()->create($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "id": 7,
    "date": "1538590526"
  },
  "account_id": 187157
}', $response);
    }

    function testUpdate(){
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "id" => 7
        );
        $response = $client->message()->update($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "id": "7",
    "date": "1538590526"
  },
  "account_id": 187157
}', $response);
    }

}

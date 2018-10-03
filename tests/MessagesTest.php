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
      "last_save": "1537912999",
    },
    {
      "id": "2",
      "alias": "Abandoned Cart: Did we lose you?",
      "type": "Template",
      "last_save": "1496332432",
    }
  ],
  "account_id": 187157,
  "misc": []
}', $response);
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

}

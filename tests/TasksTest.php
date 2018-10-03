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
        $response = $client->task()->reschedule($requestParams);
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

    function testUpdate()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "id" => 1
        );
        $response = $client->task()->update($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "attrs": {
      "date_due": "4",
      "id": "1"
    }
  },
  "account_id": 187157
}', $response);
    }

    function testRetrieveSingle()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "id" => 1
        );
        $response = $client->task()->retrieveSingle($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "id": "1",
    "owner": "1",
    "drip_id": "0",
    "contact_id": "2",
    "step_num": "0",
    "subject": "task_subject_here",
    "date_assigned": "1538513596",
    "date_due": "1538859196",
    "date_complete": null,
    "status": "0",
    "type": "0",
    "details": "task instructions go here!",
    "hidden": "0",
    "call_outcome_id": "0",
    "item_id": "5",
    "notifications": null,
    "rules": null,
    "object_type_id": "0",
    "object_name": "Contacts"
  },
  "account_id": 187157
}', $response);
    }

    function testRetrieveMultiple()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array();
        $response = $client->task()->retrieveMultiple($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": [
    {
      "id": "1",
      "owner": "1",
      "drip_id": "0"
    },
    {
      "id": "2",
      "owner": "1",
      "drip_id": "0"
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

        $response = $client->task()->retrieveMultiplePaginated($requestParams);
        $object_data = array();
        $object_data[] = json_decode('{
  "code": 0,
  "data": [
    {
      "id": "1",
      "owner": "1",
      "drip_id": "0"
    },
    {
      "id": "2",
      "owner": "1",
      "drip_id": "0"
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
        $response = $client->task()->retrieveMeta($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "1": {
      "name": "Task",
      "fields": {
        "owner": {
          "alias": "Assignee",
          "type": "parent",
          "required": "0",
          "unique": "0",
          "editable": "1",
          "deletable": "1",
          "parent_object": 2
        },
        "contact_id": {
          "alias": "Contact",
          "type": "parent",
          "required": "0",
          "unique": "0",
          "editable": "0",
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
        $response = $client->task()->retrieveCollectionInfo($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "listFields": [
      "",
      "owner",
      "subject",
      "status",
      "date_assigned",
      "date_due",
      "date_complete",
      "call_outcome_id",
      "contact_id"
    ],
    "listFieldSettings": [],
    "cardViewSettings": [],
    "viewMode": [],
    "count": "3"
  },
  "account_id": 187157
}', $response);
    }
}

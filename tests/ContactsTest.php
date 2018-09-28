<?php

use OntraportAPI\Ontraport;
use OntraportAPI\Tests\Mock\MockCurlClient;
use PHPUnit\Framework\TestCase;

class ContactsTest extends TestCase
{

    public function testRetrieveSingle()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "id" => 27
        );
        $response = $client->contact()->retrieveSingle($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "id": "1",
    "owner": "1",
    "firstname": "unit",
    "lastname": "test"
  },
  "account_id": 50
}', $response);

    }

    public function testRetrieveMultiplePaginated()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "start" => 0,
            "range" => 50,
        );

        $response = $client->contact()->retrieveMultiplePaginated($requestParams);

        $object_data = array();
        $object_data[] = json_decode("{
  \"code\": 0,
  \"data\": [
    {
      \"id\": \"5\",
      \"owner\": \"1\",
      \"firstname\": \"Joe\",
      \"lastname\": \"Johnson\"
    },
    {
      \"id\": \"6\",
      \"owner\": \"1\",
      \"firstname\": \"Mike\",
      \"lastname\": \"Michaels\"
    }
  ],
  \"account_id\": 50,
  \"misc\": []
}", true);

        $this->assertEquals(json_encode($object_data), $response);
    }

    public function testRetrieveMultiple()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array();
        $response = $client->contact()->retrieveMultiple($requestParams);
        $this->assertEquals("{
  \"code\": 0,
  \"data\": [
    {
      \"id\": \"5\",
      \"owner\": \"1\",
      \"firstname\": \"Joe\",
      \"lastname\": \"Johnson\"
    },
    {
      \"id\": \"6\",
      \"owner\": \"1\",
      \"firstname\": \"Mike\",
      \"lastname\": \"Michaels\"
    }
  ],
  \"account_id\": 50,
  \"misc\": []
}", $response);
    }

    public function testDeleteSingle()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "id" => 2
        );
        $response = $client->contact()->deleteSingle($requestParams);
        $this->assertEquals('{
  "code": 0,
  "account_id": 50
}', $response);
    }

    public function testDeleteMultiple()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "id" => 2
        );
        $response = $client->contact()->deleteMultiple($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": "Deleted",
  "account_id": 50
}', $response);
    }

    public function testCreate()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "firstname" => "unit",
            "lastname" => "test",
        );
        $response = $client->contact()->create($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "firstname": "unit",
    "lastname": "test",
    "use_utm_names": "false",
    "id": "8",
    "owner": "1",
  },
  "account_id": 50
}', $response);
    }

    public function testUpdate()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "id" => 8,
            "firstname" => "unitUpdated",
        );
        $response = $client->contact()->update($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "attrs": {
      "firstname": "unitUpdated",
      "dlm": "1538154601",
      "id": "8"
    }
  },
  "account_id": 50
}', $response);
    }

    public function testRetrieveMeta()
    {
        {
            $mock_curl = new MockCurlClient();
            $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
            $response = $client->contact()->retrieveMeta();
            $this->assertEquals('{
  "code": 0,
  "data": {
    "0": {
      "name": "Contact",
      "fields": {
        "firstname": {
          "alias": "First Name",
          "type": "text",
          "required": "0",
          "unique": "0",
          "editable": "1",
          "deletable": "0"
        },
        "lastname": {
          "alias": "Last Name",
          "type": "text",
          "required": "0",
          "unique": "0",
          "editable": "1",
          "deletable": "0"
        },
        "email": {
          "alias": "Email",
          "type": "email",
          "required": "0",
          "unique": "0",
          "editable": "1",
          "deletable": "0"
        }
      }
    }
  },
  "account_id": 50
}', $response);
        }
    }

    function testSaveOrUpdateContact()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "firstname" => "unitUpdated",
            "lastname" => "updatedLastName",
        );
        $response = $client->contact()->saveOrUpdate($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "use_utm_names": "false",
    "firstname": "unitUpdated",
    "lastname": "updatedLastName",
    "id": "9",
    "owner": "1",
  },
  "account_id": 50
}', $response);
    }

    function testRetrieveFields()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array();
        $response = $client->contact()->retrieveFields($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "1": {
      "id": 1,
      "name": "Contact Information",
      "description": null,
      "fields": [
        [
          {
            "id": 198,
            "alias": "Name",
            "field": "fn",
            "type": "mergefield",
            "required": 0,
            "unique": 0,
            "editable": 0,
            "deletable": 0,
            "options": "<op:merge field=\'firstname\'>X</op:merge> <op:merge field=\'lastname\'>X</op:merge>"
          },
          {
            "id": 1,
            "alias": "First Name",
            "field": "firstname",
            "type": "text",
            "required": 0,
            "unique": 0,
            "editable": 1,
            "deletable": 0,
            "options": ""
          }
        ]
      ]
    }
  },
  "account_id": 50
}', $response);
    }

}

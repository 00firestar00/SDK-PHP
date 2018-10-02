<?php

use OntraportAPI\Ontraport;
use OntraportAPI\Tests\Mock\MockCurlClient;
use PHPUnit\Framework\TestCase;

class ObjectsTest extends TestCase
{

    public function testRetrieveSingle()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "objectID" => 0,
            "id" => 1
        );
        $response = $client->object()->retrieveSingle($requestParams);
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
            "objectID" => 0,
            "start" => 0,
            "range" => 50,
        );

        $response = $client->object()->retrieveMultiplePaginated($requestParams);

        $object_data = array();
        $object_data[] = json_decode('{
  "code": 0,
  "data": [
    {
      "id": "8",
      "owner": "1",
      "firstname": "unitUpdated",
      "lastname": "test",
    },
    {
      "id": "10",
      "owner": "1",
      "firstname": "unit",
      "lastname": "test",
    }
  ],
  "account_id": 50,
  "misc": []
}', true);

        $this->assertEquals(json_encode($object_data), $response);
    }


    public function testRetrieveMultiple()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array("objectID" => 0);
        $response = $client->object()->retrieveMultiple($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": [
    {
      "id": "8",
      "owner": "1",
      "firstname": "unitUpdated",
      "lastname": "test",
    },
    {
      "id": "10",
      "owner": "1",
      "firstname": "unit",
      "lastname": "test",
    }
  ],
  "account_id": 50,
  "misc": []
}', $response);
    }

    public function testRetrieveIdByEmail(){
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array("objectID" => 0, "email" => "unit@test.com");
        $response = $client->object()->retrieveIdByEmail($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "id": "10"
  },
  "account_id": 50
}', $response);
    }

    public function testDeleteSingle()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "objectID" => 0,
            "id" => 2
        );
        $response = $client->object()->deleteSingle($requestParams);
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
            "objectID" => 0,
            "id" => 2
        );
        $response = $client->object()->deleteMultiple($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": "Deleted",
  "account_id": 50
}', $response);
    }

    public function testRetrieveMeta()
    {
        {
            $mock_curl = new MockCurlClient();
            $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
            $response = $client->object()->retrieveMeta();
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

    function testAddTagByName()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(json_decode('{
  "objectID": 0,
  "ids": [
    10
  ],
  "add_names": [
    "tag_name_here"
  ]
}'));
        $response = $client->object()->addTagByName($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": "The tag is now being processed.",
  "account_id": 50
}', $response);
    }

    function testRetrieveAllWithTag()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "objectID" => 0,
            "tag_name" => "tag_name_here"
        );
        $response = $client->object()->retrieveAllWithTag($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": [
    {
      "id": "10",
      "owner": "1",
      "firstname": "unit",
      "lastname": "test",
    }
  ],
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
        $response = $client->object()->create($requestParams);
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


}

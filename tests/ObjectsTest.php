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
      "lastname": "test"
    },
    {
      "id": "10",
      "owner": "1",
      "firstname": "unit",
      "lastname": "test"
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
      "lastname": "test"
    },
    {
      "id": "10",
      "owner": "1",
      "firstname": "unit",
      "lastname": "test"
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
  "account_id": 187157
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

    function testSaveOrUpdate()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "objectID" => 0,
            "firstname" => "unitUpdated",
            "lastname" => "updatedLastName",
        );
        $response = $client->object()->saveOrUpdate($requestParams);
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

    public function testUpdate()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "objectID" => 0,
            "id" => 8,
            "firstname" => "unitUpdated",
        );
        $response = $client->object()->update($requestParams);
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

    function testRetrieveFields()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array();
        $response = $client->object()->retrieveFields($requestParams);
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

    function testCreateFields()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(json_decode('{
  "objectID": 0,
  "name": "string1",
  "description": "string2",
  "fields": [
        [
      {
          "alias": "string",
        "type": "text",
        "required": 0,
        "unique": 0,
        "options": {
          "add": [
              "string"
          ],
          "remove": [
              "string"
          ],
          "replace": [
              "string"
          ]
        }
      }
    ]
  ]
}'));
        $response = $client->object()->createFields($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "success": {
      "f1557": "string"
    },
    "error": []
  },
  "account_id": 50
}', $response);
    }

    function testUpdateFields()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(json_decode('{
  "objectID": 0,
  "name": "string1",
  "description": "string2",
  "fields": [
    [
      {
        "alias": "string",
        "type": "text",
        "required": 0,
        "unique": 0,
        "options": {
          "add": [
            "UPDATED!"
          ],
          "remove": [
            "string"
          ],
          "replace": [
            "string"
          ]
        }
      }
    ]
  ]
}'));
        $response = $client->object()->updateFields($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "success": {
      "f1557": "string",
      "description": "string2"
    }
  },
  "account_id": 50
}', $response);
    }

    public function testDeleteFields()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "field" => "f1559"
        );
        $response = $client->object()->deleteFields($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": "Deleted",
  "account_id": 50
}', $response);
    }

    public function testPause()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "objectID" => 6,
            "ids" => 1,
        );
        $response = $client->object()->pause($requestParams);
        $this->assertEquals('{
  "code": 0,
  "account_id": 187157
}', $response);
    }

    public function testUnpause()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "objectID" => 6,
            "ids" => 1,
        );
        $response = $client->object()->unpause($requestParams);
        $this->assertEquals('{
  "code": 0,
  "account_id": 187157
}', $response);
    }

    public function testAddToSequence()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "objectID" => 0,
            "ids" => 3,
            "add_list" => 140
        );
        $response = $client->object()->addToSequence($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": "The subscription is now being processed.",
  "account_id": 187157
}', $response);
    }

    public function testRemoveFromSequence()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "objectID" => 0,
            "ids" => 3,
            "add_list" => 140
        );
        $response = $client->object()->removeFromSequence($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": "The subscription is now being processed.",
  "account_id": 187157
}', $response);
    }


    public function testSubscribe()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "objectID" => 0,
            "ids" => 3,
            "add_list" => 140
        );
        $response = $client->object()->subscribe($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": "The subscription is now being processed.",
  "account_id": 187157
}', $response);
    }


    public function testUnsubscribe()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "objectID" => 0,
            "ids" => 3,
            "add_list" => 140
        );
        $response = $client->object()->unsubscribe($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": "The subscription is now being processed.",
  "account_id": 187157
}', $response);
    }

    public function testAddTag()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "objectID" => 0,
            "ids" => 3,
            "add_list" => 1
        );
        $response = $client->object()->addTag($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": "The tag is now being processed.",
  "account_id": 187157
}', $response);
    }

    public function testRemoveTag()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "objectID" => 0,
            "ids" => 3,
            "add_list" => 1
        );
        $response = $client->object()->removeTag($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": "The tag is now being processed.",
  "account_id": 187157
}', $response);
    }

    function testRemoveTagByName()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(json_decode('{
  "objectID": 0,
  "ids": [
    1
  ],
  "remove_names": [
    "tag_name_here"
  ]
}'));
        $response = $client->object()->removeTagByName($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": "The tag is now being processed.",
  "account_id": 187157
}', $response);
    }

}

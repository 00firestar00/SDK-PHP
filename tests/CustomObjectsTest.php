<?php

use OntraportAPI\Ontraport;
use OntraportAPI\Tests\Mock\MockCurlClient;
use PHPUnit\Framework\TestCase;

class CustomObjectsTest extends TestCase
{

    function testRetrieveSingle()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "id" => 10000
        );
        $response = $client->custom(10000)->retrieveSingle($requestParams);
        $this->assertEquals("{
  \"code\": 0,
  \"data\": {
    \"id\": \"1\",
    \"owner\": \"1\",
    \"firstname\": \"unit\",
    \"lastname\": \"test\"
  },
  \"account_id\": 50
}", $response);
    }

    function testRetrieveMultiple()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array();
        $response = $client->custom(10000)->retrieveMultiple($requestParams);
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

    function testRetrieveMultiplePaginated()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "start" => 0,
            "range" => 50,
        );

        $response = $client->custom(10000)->retrieveMultiplePaginated($requestParams);
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
}');

        $this->assertEquals(json_encode($object_data), $response);
    }

    function testRetrieveMeta()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array();
        $response = $client->custom(10000)->retrieveMeta($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "0": {
      "name": "Contact",
      "fields": {
        "f1568": {
          "alias": "fdsfa",
          "type": "parent",
          "required": "0",
          "unique": "0",
          "editable": null,
          "deletable": "0",
          "parent_object": "10000"
        },
        "firstname": {
          "alias": "First Name",
          "type": "text",
          "required": "0",
          "unique": "0",
          "editable": "1",
          "deletable": "0"
        }
      }
    },
    "146": {
      "name": "Order",
      "fields": {}
    },
    "10000": {
      "name": "oTemp",
      "fields": {
        "f1567": {
          "alias": "asfdas",
          "type": "parent",
          "required": "0",
          "unique": "0",
          "editable": null,
          "deletable": "0"
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
        $response = $client->custom(10000)->retrieveCollectionInfo($requestParams);
        $this->assertEquals("{\"code\": 0,
                      \"data\": {
                        \"listFields\": [
                          \"fn\",
                          \"email\",
                          \"office_phone\",
                          \"date\",
                          \"grade\",
                          \"dla\",
                          \"contact_id\"
                        ],
                        \"listFieldSettings\": [],
                        \"cardViewSettings\": [],
                        \"viewMode\": [],
                        \"count\": \"2\"
                      },
                      \"account_id\": 50
                    }", $response);
    }


    public function testCreate()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "firstname" => "unit",
            "lastname" => "test",
        );
        $response = $client->custom(10000)->create($requestParams);
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
        $response = $client->custom(10000)->update($requestParams);
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
    function testSaveOrUpdate()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "firstname" => "unitUpdated",
            "lastname" => "updatedLastName",
        );
        $response = $client->custom(10000)->saveOrUpdate($requestParams);
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
        $response = $client->custom(10000)->retrieveFields($requestParams);
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
        $response = $client->custom(10000)->createFields($requestParams);
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
        $response = $client->custom(10000)->updateFields($requestParams);
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
        $response = $client->custom(10000)->deleteFields($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": "Deleted",
  "account_id": 50
}', $response);
    }
}

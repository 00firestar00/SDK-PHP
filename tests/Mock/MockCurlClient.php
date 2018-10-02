<?php


namespace OntraportAPI\tests\Mock;

use OntraportAPI\CurlClient;
use OntraportAPI\Ontraport as O;

class MockCurlClient extends CurlClient
{


    public function httpRequest($requestParams, $url, $method, $requiredParams, $options)
    {
        $API_BASE = O::REQUEST_URL . '/' . O::API_VERSION . '/';

        if($this->str_contains($url, 'Contact') or $this->str_contains($url, 'object')) {
            if (($url === $API_BASE . 'Contact' or $url === $API_BASE . 'object') and $method === 'get') {
                return $this->getSingleContact();
            } elseif (($url === $API_BASE . 'Contact' or $url === $API_BASE . 'object') and $method === 'delete') {
                return $this->deleteSingleContact();
            } elseif (($url === $API_BASE . 'Contacts/getInfo'or $url === $API_BASE . 'objects/getInfo')) {
                return $this->getInfo();
            } elseif (($url === $API_BASE . 'Contacts' or $url === $API_BASE . 'objects') and $method === 'get') {
                return $this->getMultipleContacts();
            } elseif (($url === $API_BASE . 'Contacts' or $url === $API_BASE . 'objects') and $method === 'delete') {
                return $this->deleteMultipleContacts();
            } elseif (($url === $API_BASE . 'Contacts' or $url === $API_BASE . 'objects') and $method === 'post') {
                return $this->createSingleContact();
            } elseif (($url === $API_BASE . 'Contacts' or $url === $API_BASE . 'objects') and $method === 'put') {
                return $this->updateSingleContact();
            } elseif ($url === $API_BASE . 'Contacts/meta' or $url === $API_BASE . 'objects/meta') {
                return $this->getMeta();
            } elseif ($url === $API_BASE . 'Contacts/saveorupdate' or $url === $API_BASE . 'objects/saveorupdate') {
                return $this->saveOrUpdateContact();
            } elseif (($url === $API_BASE . 'Contacts/fieldeditor' or $url === $API_BASE . 'objects/fieldeditor') and $method === 'get') {
                return $this->retrieveFields();
            } elseif (($url === $API_BASE . 'Contacts/fieldeditor' or $url === $API_BASE . 'objects/fieldeditor') and $method === 'post') {
                return $this->createFields();
            } elseif (($url === $API_BASE . 'Contacts/fieldeditor' or $url === $API_BASE . 'objects/fieldeditor') and $method === 'put') {
                return $this->updateFields();
            } elseif (($url === $API_BASE . 'Contacts/fieldeditor' or $url === $API_BASE . 'objects/fieldeditor') and $method === 'delete') {
                return $this->deleteFields();
            }

            //Applicable to Objects but not contacts
            elseif ($url === $API_BASE . 'objects/tagByName' and $method === 'put') {
                return $this->tagObjectByName();
            } elseif ($url === $API_BASE . 'object/getByEmail' and $method === 'get') {
                return $this->getObjectByEmail();
            } elseif ($url === $API_BASE . 'objects/tag' and $method === 'get') {
                return $this->getObjectsWithTag();
            }
        }


        return parent::httpRequest($requestParams, $url, $method, $requiredParams, $options);
    }

    function str_contains($haystack, $needle)
    {
        return strpos($haystack, $needle) !== false;
    }

    function getSingleContact()
    {
        return "{
  \"code\": 0,
  \"data\": {
    \"id\": \"1\",
    \"owner\": \"1\",
    \"firstname\": \"unit\",
    \"lastname\": \"test\"
  },
  \"account_id\": 50
}";
    }

    function getInfo()
    {
        return "{\"code\": 0,
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
                    }";
    }

    function getMultipleContacts()
    {
        return '{
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
}';
    }

    function deleteSingleContact()
    {
        return '{
  "code": 0,
  "account_id": 50
}';
    }

    function deleteMultipleContacts()
    {
        return '{
  "code": 0,
  "data": "Deleted",
  "account_id": 50
}';
    }

    function createSingleContact()
    {
        return '{
  "code": 0,
  "data": {
    "firstname": "unit",
    "lastname": "test",
    "use_utm_names": "false",
    "id": "8",
    "owner": "1",
  },
  "account_id": 50
}';
    }

    function updateSingleContact()
    {
        return '{
  "code": 0,
  "data": {
    "attrs": {
      "firstname": "unitUpdated",
      "dlm": "1538154601",
      "id": "8"
    }
  },
  "account_id": 50
}';
    }

    function getMeta()
    {
        return '{
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
}';
    }

    function saveOrUpdateContact()
    {
        return '{
  "code": 0,
  "data": {
    "use_utm_names": "false",
    "firstname": "unitUpdated",
    "lastname": "updatedLastName",
    "id": "9",
    "owner": "1",
  },
  "account_id": 50
}';
    }

    function retrieveFields()
    {
        return '{
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
}';
    }

    function createFields()
    {
        return '{
  "code": 0,
  "data": {
    "success": {
      "f1557": "string"
    },
    "error": []
  },
  "account_id": 50
}';

    }

    function updateFields()
    {
        return '{
  "code": 0,
  "data": {
    "success": {
      "f1557": "string",
      "description": "string2"
    }
  },
  "account_id": 50
}';
    }

    function deleteFields()
    {
        return '{
  "code": 0,
  "data": "Deleted",
  "account_id": 50
}';
    }

    function getObjectByEmail()
    {
        return '{
  "code": 0,
  "data": {
    "id": "10"
  },
  "account_id": 50
}';
    }

    function tagObjectByName()
    {
        return '{
  "code": 0,
  "data": "The tag is now being processed.",
  "account_id": 50
}';
    }

    function getObjectsWithTag(){
        return '{
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
}';
    }

}

<?php


namespace OntraportAPI\tests\Mock;

use OntraportAPI\CurlClient;
use OntraportAPI\Ontraport as O;

class MockCurlClient extends CurlClient
{

    public function httpRequest($requestParams, $url, $method, $requiredParams, $options)
    {
        $API_BASE = O::REQUEST_URL . '/' . O::API_VERSION . '/';
        if ($url === $API_BASE . 'Contact' and $method === 'get') {
            return $this->getSingleContact();
        } elseif ($url === $API_BASE . 'Contact' and $method === 'delete') {
            return $this->deleteSingleContact();
        } elseif ($url === $API_BASE . 'Contacts/getInfo') {
            return $this->getInfo();
        } elseif ($url === $API_BASE . 'Contacts' and $method === 'get') {
            return $this->getMultipleContacts();
        } elseif ($url === $API_BASE . 'Contacts' and $method === 'delete') {
            return $this->deleteMultipleContacts();
        } elseif ($url === $API_BASE . 'Contacts' and $method === 'post') {
            return $this->createSingleContact();
        } elseif ($url === $API_BASE . 'Contacts' and $method === 'put') {
            return $this->updateSingleContact();
        } elseif ($url === $API_BASE . 'Contacts/meta') {
            return $this->getMeta();
        } elseif ($url === $API_BASE . 'Contacts/saveorupdate') {
            return $this->saveOrUpdateContact();
        } elseif ($url === $API_BASE . 'Contacts/fieldeditor' and $method === 'get'){
            return $this->retrieveFields();
        }

        return parent::httpRequest($requestParams, $url, $method, $requiredParams, $options);
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
        return " {\"code\": 0,
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
        return "{
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
}";
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
}

<?php


namespace OntraportAPI\tests\Mock;

use OntraportAPI\CurlClient;

class MockCurlClient extends CurlClient
{
    public function httpRequest($requestParams, $url, $method, $requiredParams, $options)
    {
        if ($url === "https://api.ontraport.com/1/Contact" and $method === "get") {
            return $this->getSingleContact();
        } elseif ($url === "https://api.ontraport.com/1/Contact" and $method === "delete") {
            return $this->deleteSingleContact();
        } elseif ($url === "https://api.ontraport.com/1/Contacts/getInfo") {
            return $this->getInfo();
        } elseif ($url === "https://api.ontraport.com/1/Contacts" and $method === "get") {
            return $this->getMultipleContacts();
        } elseif ($url === "https://api.ontraport.com/1/Contacts" and $method === "delete") {
            return $this->deleteMultipleContacts();
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
}

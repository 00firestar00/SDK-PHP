<?php

use OntraportAPI\Ontraport;
use OntraportAPI\Tests\Mock\MockCurlClient;
use PHPUnit\Framework\TestCase;

class CreditCardsTest extends TestCase
{

    function testRetrieveSingle()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "id" => 1
        );
        $response = $client->creditcard()->retrieveSingle($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "id": "1",
    "firstname": "adsf",
    "lastname": "adsf",
    "contact_id": "2",
    "last4": "1234",
    "type": "6",
    "exp_month": "1",
    "exp_year": "2035",
    "address": "adfs",
    "address2": "afds",
    "city": "asfd",
    "state": "CA",
    "zip": "12332",
    "country": "US",
    "status": "3",
    "recent_sale": "0",
    "invoice_id": "4"
  },
  "account_id": 187157
}', $response);
    }

    function testRetrieveMultiple()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array();
        $response = $client->creditcard()->retrieveMultiple($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": [
    {
      "id": "1",
      "firstname": "adsf",
      "lastname": "adsf",
      "contact_id": "2",
      "last4": "1234",
      "type": "6",
      "exp_month": "1",
      "exp_year": "2035",
      "address": "adfs",
      "address2": "afds",
      "city": "asfd",
      "state": "CA",
      "zip": "12332",
      "country": "US",
      "status": "3",
      "recent_sale": "0",
      "invoice_id": "4"
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
        $response = $client->creditcard()->retrieveMultiplePaginated($requestParams);
        $object_data = array();
        $object_data[] = json_decode('{
  "code": 0,
  "data": [
    {
      "id": "1",
      "firstname": "adsf",
      "lastname": "adsf",
      "contact_id": "2",
      "last4": "1234",
      "type": "6",
      "exp_month": "1",
      "exp_year": "2035",
      "address": "adfs",
      "address2": "afds",
      "city": "asfd",
      "state": "CA",
      "zip": "12332",
      "country": "US",
      "status": "3",
      "recent_sale": "0",
      "invoice_id": "4"
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
        $response = $client->creditcard()->retrieveMeta($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "45": {
      "name": "CreditCard",
      "fields": {
        "contact_id": {
          "alias": "Contact",
          "type": "parent",
          "required": "0",
          "unique": "0",
          "editable": "0",
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
        $response = $client->creditcard()->retrieveCollectionInfo($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "listFields": [
      "contact_id",
      "last4",
      "exp_month",
      "exp_year"
    ],
    "listFieldSettings": [],
    "cardViewSettings": [],
    "viewMode": [],
    "count": "1"
  },
  "account_id": 187157
}', $response);
    }

    function testSetDefault(){
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array();
        $response = $client->creditcard()->setDefault($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "id": "1",
    "status": "3"
  },
  "account_id": 187157
}', $response);
    }


}

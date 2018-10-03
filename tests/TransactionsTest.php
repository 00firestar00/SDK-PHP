<?php

use OntraportAPI\Ontraport;
use OntraportAPI\Tests\Mock\MockCurlClient;
use PHPUnit\Framework\TestCase;

class TransactionsTest extends TestCase
{


    function testRetrieveSingle()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "id" => 1
        );
        $response = $client->transaction()->retrieveSingle($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "id": "1",
    "hidden": "0",
    "status": "0",
    "contact_id": "2"
  },
  "account_id": 187157
}', $response);
    }

    function testRetrieveMultiple()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array();
        $response = $client->transaction()->retrieveMultiple($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": [
    {
      "id": "1",
      "hidden": "0",
      "status": "0",
      "contact_id": "2",
      "order_id": "0",
      "form_id": "0",
      "lp_id": null,
      "cc_id": null,
      "gateway_id": "0",
      "date": "1538603619",
      "template_id": "1",
      "subtotal": "1.00",
      "tax": "0.00",
      "shipping": "0.00",
      "total": "1.00",
      "zip": "",
      "city": null,
      "state": null,
      "county": null,
      "tax_city": "0.00",
      "tax_state": "0.00",
      "tax_county": "0.00",
      "external_order_id": "",
      "oprid": "0",
      "last_recharge_date": "1538603619",
      "recharge_attempts": null,
      "recharge": null,
      "contact_name": "unit test"
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

        $response = $client->transaction()->retrieveMultiplePaginated($requestParams);
        $object_data = array();
        $object_data[] = json_decode('{
  "code": 0,
  "data": [
    {
      "id": "1",
      "hidden": "0",
      "status": "0",
      "contact_id": "2",
      "order_id": "0",
      "form_id": "0",
      "lp_id": null,
      "cc_id": null,
      "gateway_id": "0",
      "date": "1538603619",
      "template_id": "1",
      "subtotal": "1.00",
      "tax": "0.00",
      "shipping": "0.00",
      "total": "1.00",
      "zip": "",
      "city": null,
      "state": null,
      "county": null,
      "tax_city": "0.00",
      "tax_state": "0.00",
      "tax_county": "0.00",
      "external_order_id": "",
      "oprid": "0",
      "last_recharge_date": "1538603619",
      "recharge_attempts": null,
      "recharge": null,
      "contact_name": "unit test"
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
        $response = $client->transaction()->retrieveMeta($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "46": {
      "name": "Invoice",
      "fields": {
        "date": {
          "alias": "Date Created",
          "type": "timestamp",
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
        $response = $client->transaction()->retrieveCollectionInfo($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "listFields": [
      "status",
      "total",
      "contact_name",
      "date"
    ],
    "listFieldSettings": [],
    "cardViewSettings": [],
    "viewMode": [],
    "count": "1",
    "sums": {
      "total": 1
    }
  },
  "account_id": 187157
}', $response);
    }

    function testConvertToCollections(){
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array();
        $response = $client->transaction()->convertToCollections($requestParams);
        $this->assertEquals('{
  "code": 0,
  "account_id": 187157
}', $response);
    }

    function testConvertToDecline(){
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array();
        $response = $client->transaction()->convertToDeclined($requestParams);
        $this->assertEquals('{
  "code": 0,
  "account_id": 187157
}', $response);
    }

    function testMarkAsPaid(){
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array();
        $response = $client->transaction()->markAsPaid($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": [],
  "account_id": 187157
}', $response);
    }

    function testRefund(){
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = json_encode('{
  "objectID": 46,
  "ids": [
    1
  ]
}');
        $response = $client->transaction()->refund($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": "Refunded",
  "account_id": 187157
}', $response);
    }

    function testRerun(){
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = json_encode('{
  "objectID": 46,
  "ids": [
    1
  ]
}');
        $response = $client->transaction()->rerun($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": 1,
  "account_id": 187157
}', $response);
    }

    function testWriteOff(){
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = json_encode('{
  "objectID": 46,
  "ids": [
    1
  ]
}');
        $response = $client->transaction()->writeOff($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": 1,
  "account_id": 187157
}', $response);
    }

    function testVoid(){
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = json_encode('{
  "objectID": 46,
  "ids": [
    2
  ]
}');
        $response = $client->transaction()->void($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": "Voided",
  "account_id": 187157
}', $response);
    }

    function testResendInvoice(){
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = json_encode('{
  "objectID": 46,
  "ids": [
    3
  ]
}');
        $response = $client->transaction()->resendInvoice($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": "",
  "account_id": 187157
}', $response);
    }

    function testRerunCommission(){
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = json_encode('{
  "objectID": 46,
  "ids": [
    3
  ]
}');
        $response = $client->transaction()->rerunCommission($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": "Re-ran commissions",
  "account_id": 187157
}', $response);
    }

}

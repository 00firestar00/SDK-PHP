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

    function testProcessManual(){
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = json_encode('{
  "contact_id": 2,
  "chargeNow": "chargeNow",
  "trans_date": 0,
  "invoice_template": 1,
  "gateway_id": 1,
  "cc_id": 1,
  "offer": {
    "cc_id": 0,
    "products": [
      {
        "quantity": 1,
        "total": 0,
        "shipping": false,
        "tax": false,
        "price": [
          {
            "price": 0,
            "payment_count": 0,
            "unit": "day",
            "id": 0
          }
        ],
        "type": "single",
        "owner": 0,
        "level1": 0,
        "level2": 0,
        "offer_to_affiliates": false,
        "trial_period_unit": "day",
        "trial_period_count": 0,
        "trial_price": 0,
        "setup_fee": 0,
        "setup_fee_when": "immediately",
        "setup_fee_date": "string",
        "delay_start": 0,
        "subscription_fee": 0,
        "subscription_count": 0,
        "subscription_unit": "day",
        "taxable": true,
        "id": 1
      }
    ],
    "taxes": [
      {
        "id": 1,
        "rate": 0,
        "name": "string",
        "taxShipping": true,
        "taxTotal": 0,
        "form_id": 0
      }
    ],
    "shipping": [
      {
        "id": 1,
        "name": "string",
        "price": 0,
        "form_id": 0
      }
    ],
    "delay": 0,
    "subTotal": 0,
    "grandTotal": 0,
    "hasTaxes": false,
    "hasShipping": false,
    "shipping_charge_reoccurring_orders": false,
    "send_recurring_invoice": false,
    "ccExpirationDate": ""
  },
  "billing_address": {
    "address": "string",
    "address2": "",
    "city": "string",
    "state": "string",
    "zip": "string",
    "country": "string"
  },
  "payer": {
    "ccnumber": "",
    "code": "",
    "expire_month": 0,
    "expire_year": 0
  }
}');
        $response = $client->transaction()->processManual($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "invoice_id": 4
  },
  "account_id": 187157
}', $response);
    }

    function testRetrieveOrder(){
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = array(
            "id" => 1
        );
        $response = $client->transaction()->retrieveOrder($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "products": [
      {
        "quantity": "1",
        "minQuantity": "1",
        "maxQuantity": "99",
        "total": "0.00",
        "shipping": false,
        "tax": false,
        "price": [
          {
            "price": "0.00",
            "payment_count": "1",
            "unit": "month",
            "id": "309734178098"
          }
        ],
        "type": "subscription",
        "quantityEditable": false,
        "index": "0",
        "name": "adsf",
        "id": "1",
        "uid": "c3a75463-76fb-0e7c-b381-6e956dd69e57",
        "product_type": null
      }
    ],
    "shipping": null,
    "delay": "0",
    "invoice_template": "1",
    "subTotal": "0",
    "grandTotal": "0",
    "hasTaxes": false,
    "hasShipping": false,
    "paypalValid": false,
    "offerCoupon": false,
    "coupon": null,
    "shipping_charge_reoccurring_orders": false,
    "resorted": null,
    "cc_id": "1",
    "send_recurring_invoice": "0",
    "offer_id": 7,
    "order_id": "1",
    "payment_next_date": "1541361600",
    "status": "0",
    "gateway_id": "1",
    "affiliate_id": "0"
  },
  "account_id": 187157
}', $response);
    }

    function testUpdateOrder(){
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678", "Key5678", $mock_curl);
        $requestParams = json_encode('{
  "objectID": 52,
  "contact_id": 2,
  "offer": {
    "cc_id": 0,
    "order_id": 1,
    "offer_id": 9,
    "products": [
      {
        "quantity": 1,
        "total": 0,
        "shipping": false,
        "tax": false,
        "price": [
          {
            "price": 0,
            "payment_count": 0,
            "unit": "day",
            "id": 0
          }
        ],
        "type": "single",
        "owner": 0,
        "level1": 0,
        "level2": 0,
        "offer_to_affiliates": false,
        "trial_period_unit": "day",
        "trial_period_count": 0,
        "trial_price": 0,
        "setup_fee": 0,
        "setup_fee_when": "immediately",
        "setup_fee_date": "string",
        "delay_start": 0,
        "subscription_fee": 0,
        "subscription_count": 0,
        "subscription_unit": "day",
        "taxable": true,
        "id": 0
      }
    ],
    "taxes": [
      {
        "id": 0,
        "rate": 0,
        "name": "string",
        "taxShipping": true,
        "taxTotal": 0,
        "form_id": 0
      }
    ],
    "shipping": [
      {
        "id": 0,
        "name": "string",
        "price": 0,
        "form_id": 0
      }
    ],
    "delay": 0,
    "subTotal": 0,
    "grandTotal": 0,
    "hasTaxes": false,
    "hasShipping": false,
    "shipping_charge_reoccurring_orders": false,
    "ccExpirationDate": ""
  },
  "billing_address": {
    "address": "string",
    "address2": "",
    "city": "string",
    "state": "string",
    "zip": "string",
    "country": "string"
  },
  "payer": {
    "ccnumber": "",
    "code": "",
    "expire_month": 0,
    "expire_year": 0
  }
}');
        $response = $client->transaction()->updateOrder($requestParams);
        $this->assertEquals('{
  "code": 0,
  "data": {
    "id": "1",
    "contact_id": "2",
    "offer_id": "9",
    "affiliate": "0",
    "cc_id": "1",
    "name": "adsf",
    "payment_next_date": "1541361600",
    "orig_month_date": "0",
    "unit": "month",
    "count": "1",
    "gateway_id": "169326",
    "shipping_address": null,
    "shipping_city": null,
    "shipping_state": null,
    "shipping_zip": null,
    "shipping_country": null,
    "shipping_last_charge": "0",
    "shipping_service": null,
    "status": "0",
    "hidden": "0",
    "dlm": "1538684779",
    "order_form_json": null,
    "cancellation_date": "0",
    "next_sub": "0.00",
    "tax": "0.00",
    "shipping": "0.00",
    "next_charge": "0.00",
    "transactions": "1",
    "transactions_remaining": "0",
    "charged": "0.00"
  },
  "account_id": 187157
}', $response);
    }
}

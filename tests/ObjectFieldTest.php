<?php

use OntraportAPI\Ontraport;
use OntraportAPI\Tests\Mock\MockCurlClient;
use PHPUnit\Framework\TestCase;
use OntraportAPI\ObjectType;
use OntraportAPI\Models\FieldEditor\ObjectField;
use OntraportAPI\Models\FieldEditor\ObjectSection;

class ObjectFieldTest extends TestCase
{
    function testCreateFields()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678","Key5678", $mock_curl);

        $myField = new ObjectField("My New Field", ObjectField::TYPE_TEXT);

        $mySection = new ObjectSection("Contact Information", array($myField));

        $requestParams = $mySection->toRequestParams();
        $requestParams["objectID"] = ObjectType::CONTACT;
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
}' , $response);
    }

//    function testCreateFields()
//    {
//        $mock_curl = new MockCurlClient();
//        $client = new Ontraport("2_AppID_12345678","Key5678", $mock_curl);
//
//        $myField = new ObjectField("My New Field", ObjectField::TYPE_TEXT);
//        $myDropDown = new ObjectField("My New Dropdown", ObjectField::TYPE_DROP);
//        $myDropDown->addDropOptions(array("first", "second", "third"));
//
//        $mySection = new ObjectSection("Contact Information", array($myField, $myDropDown));
//
//        $requestParams = $mySection->toRequestParams();
//        $requestParams["objectID"] = ObjectType::CONTACT;
//        $response = $client->object()->createFields($requestParams);
//        $this->assertEquals('{
//  "code": 0,
//  "data": {
//    "success": {
//      "f1557": "string"
//    },
//    "error": []
//  },
//  "account_id": 50
//}' , $response);
//    }









}

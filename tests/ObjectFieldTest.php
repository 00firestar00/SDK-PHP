<?php

use OntraportAPI\Ontraport;
use OntraportAPI\Tests\Mock\MockCurlClient;
use PHPUnit\Framework\TestCase;
use OntraportAPI\ObjectType;
use OntraportAPI\Models\FieldEditor\ObjectField;
use OntraportAPI\Models\FieldEditor\ObjectSection;

class ObjectFieldTest extends TestCase
{
    function testToRequestParams()
    {
        $myField = new ObjectField("My New Field", ObjectField::TYPE_TEXT);
        $mySection = new ObjectSection("Contact Information", array($myField));

        $requestParams = $mySection->toRequestParams();
        $this->assertEquals('{"name":"Contact Information","description":null,"fields":[[{"alias":"My New Field","required":0,"unique":0,"type":"text"}]]}' , json_encode($requestParams));
    }

    function testSetAndGetID()
    {
        $myField = new ObjectField("My New Field", ObjectField::TYPE_TEXT);
        $myField->setId(3);
        $myFieldID = $myField->getId();
        $this->assertEquals(3, $myFieldID);
    }

    function testSetAndGetFields()
    {
        $myField = new ObjectField("My New Field", ObjectField::TYPE_TEXT);
        $myField->setField("My Newer Field");
        $myNewerField = $myField->getField();
        $this->assertEquals('My Newer Field', $myNewerField);
    }

    function testSetAndGetAlias()
    {
        $myField = new ObjectField("My New Field", ObjectField::TYPE_TEXT);
        $myField->setAlias("My New Alias");
        $myNewAlias = $myField->getAlias();
        $this->assertEquals('My New Alias', $myNewAlias);
    }


    function testAddThenRemoveOptions()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678","Key5678", $mock_curl);

        $myField = new ObjectField("My New Field", ObjectField::TYPE_TEXT);
        $myDropDown = new ObjectField("My New Dropdown", ObjectField::TYPE_DROP);
        $myDropDown->addDropOptions(array("first", "second", "third"));
        $myDropDown->removeDropOptions(array("third"));

        $mySection = new ObjectSection("Contact Information", array($myField, $myDropDown));

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

    function testAddThenReplaceOptions()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678","Key5678", $mock_curl);

        $myField = new ObjectField("My New Field", ObjectField::TYPE_TEXT);
        $myDropDown = new ObjectField("My New Dropdown", ObjectField::TYPE_DROP);
        $myDropDown->addDropOptions(array("first", "second", "third"));
        $myDropDown->replaceDropOptions(array("third"));

        $mySection = new ObjectSection("Contact Information", array($myField, $myDropDown));

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
    
    /**
     * @expectedException  \OntraportAPI\Exceptions\FieldTypeException
     */
    function testFieldTypeException()
    {
        $mock_curl = new MockCurlClient();
        $client = new Ontraport("2_AppID_12345678","Key5678", $mock_curl);

        $myField = new ObjectField("My New Field", 12345);
        $myDropDown = new ObjectField("My New Dropdown", ObjectField::TYPE_DROP);
        $myDropDown->addDropOptions(array("first", "second", "third"));
        $myDropDown->replaceDropOptions(array("third"));

        $mySection = new ObjectSection("Contact Information", array($myField, $myDropDown));

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







}

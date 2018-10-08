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
        $requestParams = $myField->toRequestParams();
        $this->assertEquals('{"alias":"My New Field","required":0,"unique":0,"type":"text"}' , json_encode($requestParams));
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

    function testAddDropOptions()
    {
        $myDropDown = new ObjectField("My New Dropdown", ObjectField::TYPE_DROP);
        $myDropDown->addDropOptions(array("first", "second", "third"));
        $requestParams = $myDropDown->toRequestParams();
        $this->assertEquals('{"alias":"My New Dropdown","required":0,"unique":0,"type":"drop","options":{"add":["first","second","third"]}}' , json_encode($requestParams));
    }

    function testRemoveDropOptions()
    {
        $myDropDown = new ObjectField("My New Dropdown", ObjectField::TYPE_DROP);
        $myDropDown->removeDropOptions(array("second"));
        $requestParams = $myDropDown->toRequestParams();
        $this->assertEquals('{"alias":"My New Dropdown","required":0,"unique":0,"type":"drop","options":{"remove":["second"]}}' , json_encode($requestParams));
    }

    function testReplaceDropOptions()
    {
        $myDropDown = new ObjectField("My New Dropdown", ObjectField::TYPE_DROP);
        $myDropDown->replaceDropOptions(array("second"));
        $requestParams = $myDropDown->toRequestParams();
        $this->assertEquals('{"alias":"My New Dropdown","required":0,"unique":0,"type":"drop","options":{"replace":["second"]}}' , json_encode($requestParams));
    }

    /**
     * @expectedException  \OntraportAPI\Exceptions\FieldTypeException
     */
    function testFieldTypeException()
    {
        $myField = new ObjectField("My New Field", 12345);
    }







}

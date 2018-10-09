<?php

use OntraportAPI\Ontraport;
use PHPUnit\Framework\TestCase;
use OntraportAPI\Models\FieldEditor\ObjectField;
use OntraportAPI\ObjectType;
use OntraportAPI\Models\FieldEditor\ObjectSection;

class ObjectSectionTest extends TestCase
{
    function testToRequestParams()
    {
        $myField = new ObjectField("My New Field", ObjectField::TYPE_TEXT);
        $mySection = new ObjectSection("Contact Information", array($myField));
        $requestParams = $mySection->toRequestParams();
        $this->assertEquals('{"name":"Contact Information","description":null,"fields":[[{"alias":"My New Field","required":0,"unique":0,"type":"text"}]]}', json_encode($requestParams));
    }

    function testGetFieldByAlias()
    {
        $myField = new ObjectField("My New Field", ObjectField::TYPE_TEXT);
        $mySection = new ObjectSection("Contact Information", array($myField));
        $myFieldByAlias = $mySection->getFieldByAlias("My New Field");
        $stringMyFieldByAlias = json_encode(json_decode($myFieldByAlias));
        $this->assertEquals('{"alias":"My New Field","required":0,"unique":0,"type":"text"}', $stringMyFieldByAlias);
    }

    function testSetDescription()
    {
        $myField = new ObjectField("My New Field", ObjectField::TYPE_TEXT);
        $mySection = new ObjectSection("Contact Information", array($myField));
        $mySection->setDescription("blah blah blah...");
        $sectionWithDescription = json_encode(json_decode($mySection));
        $this->assertEquals('{"name":"Contact Information","description":"blah blah blah...","fields":[[{"alias":"My New Field","required":0,"unique":0,"type":"text"}]]}', $sectionWithDescription);
    }

    function testUpdateField()
    {
        $myField = new ObjectField("My New Field", ObjectField::TYPE_TEXT);
        $myField->setField("some_field_here");
        $mySection = new ObjectSection("Contact Information", array($myField));
        $myUpdatedField = new ObjectField("My Updated Field", ObjectField::TYPE_TEXT);
        $myUpdatedField->setField("some_field_here");
        $mySection->updateField($myUpdatedField);
        $requestParams = $mySection->toRequestParams();
        $this->assertEquals('{"name":"Contact Information","description":null,"fields":[[{"alias":"My Updated Field","required":0,"unique":0,"type":"text","field":"some_field_here"}]]}', json_encode($requestParams));
    }

    function testPutFieldsInColumn()
    {
        $myField = new ObjectField("My New Field", ObjectField::TYPE_TEXT);
        $mySection = new ObjectSection("Contact Information", array($myField));
        $secondField = new ObjectField("My 2nd Field", ObjectField::TYPE_TEXT);
        $thirdField = new ObjectField("My 3rd Field", ObjectField::TYPE_TEXT);
        $mySection->putFieldsInColumn(2, array($secondField, $thirdField));
        $requestParams = $mySection->toRequestParams();
        $this->assertEquals('{"name":"Contact Information","description":null,"fields":[[{"alias":"My New Field","required":0,"unique":0,"type":"text"}],[{"alias":"My 2nd Field","required":0,"unique":0,"type":"text"},{"alias":"My 3rd Field","required":0,"unique":0,"type":"text"}]]}', json_encode($requestParams));
    }

    /**
     * @expectedException \OntraportAPI\Exceptions\InvalidColumnIndex
     */
    function testInvalidColumnIndex()
    {
        $myField = new ObjectField("My New Field", ObjectField::TYPE_TEXT);
        $mySection = new ObjectSection("Contact Information", array($myField));
        $secondField = new ObjectField("My 2nd Field", ObjectField::TYPE_TEXT);
        $mySection->putFieldsInColumn(3, array($secondField));
        $requestParams = $mySection->toRequestParams();
        $this->assertEquals('InvalidColumnIndex should have been thrown.', json_encode($requestParams));
    }

    function testCreateFromResponse()
    {
        $responseArray = json_decode('{"name":"Contact Information","description":null,"fields":[[{"alias":"My New Field","required":0,"field":"yes","id":2,"unique":0,"type":"text","options":{"replace":["second"]}}]]}', true);
        $mySection = ObjectSection::CreateFromResponse($responseArray);
        $requestParams = $mySection->toRequestParams();
        $this->assertEquals('{"name":"Contact Information","description":null,"fields":[[{"alias":"My New Field","required":0,"unique":0,"type":"text","options":{"replace":["second"]},"id":2,"field":"yes"}]]}', json_encode($requestParams));

    }

}

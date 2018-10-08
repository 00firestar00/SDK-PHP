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
        $myDropDown = new ObjectField("My New Dropdown", ObjectField::TYPE_DROP);
        $mySection = new ObjectSection("Contact Information", array($myField, $myDropDown));
        $requestParams = $mySection->toRequestParams();
        $this->assertEquals('{"name":"Contact Information","description":null,"fields":[[{"alias":"My New Field","required":0,"unique":0,"type":"text"},{"alias":"My New Dropdown","required":0,"unique":0,"type":"drop"}]]}', json_encode($requestParams));
    }

    function testGetFieldByAlias()
    {
        $myField = new ObjectField("My New Field", ObjectField::TYPE_TEXT);
        $myDropDown = new ObjectField("My New Dropdown", ObjectField::TYPE_DROP);
        $mySection = new ObjectSection("Contact Information", array($myField, $myDropDown));
        $myFieldByAlias = $mySection->getFieldByAlias("My New Dropdown");
        $stringMyFieldByAlias = json_encode(json_decode($myFieldByAlias));
        $this->assertEquals('{"alias":"My New Dropdown","required":0,"unique":0,"type":"drop"}', $stringMyFieldByAlias);
    }
}

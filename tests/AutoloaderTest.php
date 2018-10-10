<?php

use OntraportAPI\Ontraport;
use PHPUnit\Framework\TestCase;

class AutoloaderTest extends TestCase
{
    function testLoaderBadName()
    {
        $bool = \OntraportAPI\APIAutoloader::loader("some other string");
        $this->assertFalse($bool);
    }

    function testLoaderGoodName()
    {
        $bool = \OntraportAPI\APIAutoloader::loader("OntraportAPI\Ontraport");
        $this->assertTrue($bool);
    }

    function testLoaderStartsWithBacks()
    {
        $bool = \OntraportAPI\APIAutoloader::loader("\\OntraportAPI\Ontraport");
        $this->assertTrue($bool);
    }

    function testLoaderWithClassComponents()
    {
        $bool = \OntraportAPI\APIAutoloader::loader("OntraportAPI\\Exceptions\\OntraportAPIException");
        $this->assertTrue($bool);
    }
}

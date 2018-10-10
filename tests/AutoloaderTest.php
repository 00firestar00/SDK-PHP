<?php

use OntraportAPI\Ontraport;
use PHPUnit\Framework\TestCase;

class AutoloaderTest extends TestCase
{
    function testLoaderBadName()
    {
        $bool = \OntraportAPI\APIAutoloader::loader("some other string");
        $this->assertEquals(false, $bool);
    }

    function testLoaderGoodName()
    {
        $bool = \OntraportAPI\APIAutoloader::loader("OntraportAPI\Ontraport");
        $this->assertEquals(true, $bool);
    }
}

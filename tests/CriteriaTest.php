<?php

use OntraportAPI\Ontraport;
use OntraportAPI\Tests\Mock\MockCurlClient;
use PHPUnit\Framework\TestCase;
use OntraportAPI\Criteria;

class CriteriaTest extends TestCase
{

    public function testFromArray()
    {
        $condition = new Criteria("name", "=", "name");
        $str_condition = var_export($condition, true);
        $this->assertEquals($str_condition, 'OntraportAPI\Criteria::__set_state(array(
   \'_condition\' => 
  array (
    0 => 
    array (
      \'field\' => 
      array (
        \'field\' => \'name\',
      ),
      \'op\' => \'=\',
      \'value\' => 
      array (
        \'value\' => \'name\',
      ),
    ),
  ),
))');

    }
}

<?php

use OntraportAPI\Ontraport;
use OntraportAPI\Tests\Mock\MockCurlClient;
use PHPUnit\Framework\TestCase;
use OntraportAPI\Criteria;

class CriteriaTest extends TestCase
{

    public function testBuildCondition()
    {
        $condition = new Criteria("name", "=", "name");
        $str_condition = var_export($condition, true);
        $this->assertEquals('OntraportAPI\Criteria::__set_state(array(
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
))', $str_condition);
    }

    public function testBuildConditionWithArray()
    {
        $arr = array(
            "foo" => "bar",
            "bar" => "foo",
        );
        $condition = new Criteria("foo", "IN", $arr);
        $str_condition = var_export($condition, true);
        $this->assertEquals('OntraportAPI\Criteria::__set_state(array(
   \'_condition\' => 
  array (
    0 => 
    array (
      \'field\' => 
      array (
        \'field\' => \'foo\',
      ),
      \'op\' => \'IN\',
      \'value\' => 
      array (
        \'list\' => 
        array (
          0 => 
          array (
            \'value\' => \'bar\',
          ),
          1 => 
          array (
            \'value\' => \'foo\',
          ),
        ),
      ),
    ),
  ),
))', $str_condition);
    }

    /**
     * @expectedException \OntraportAPI\Exceptions\ArrayOperatorException
     */
    public function testInvalidBuildConditionWithArray()
    {
        $arr = array(
            "foo" => "bar",
            "bar" => "foo",
        );
        $condition = new Criteria("foo", "=", $arr);
    }

    public function testAndCondition()
    {
        $condition = new Criteria("name", "=", "name");
        $condition->andCondition(1, "<", 3);
        $str_condition = var_export($condition, true);
        $this->assertEquals('OntraportAPI\Criteria::__set_state(array(
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
    1 => \'AND\',
    2 => 
    array (
      \'field\' => 
      array (
        \'field\' => 1,
      ),
      \'op\' => \'<\',
      \'value\' => 
      array (
        \'value\' => 3,
      ),
    ),
  ),
))',$str_condition);
    }

    public function testOrCondition()
    {
        $condition = new Criteria("name", "=", "name");
        $condition->orCondition(1, "<", 3);
        $str_condition = var_export($condition, true);
        $this->assertEquals('OntraportAPI\Criteria::__set_state(array(
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
    1 => \'OR\',
    2 => 
    array (
      \'field\' => 
      array (
        \'field\' => 1,
      ),
      \'op\' => \'<\',
      \'value\' => 
      array (
        \'value\' => 3,
      ),
    ),
  ),
))',$str_condition);
    }

    public function testFromArray()
    {
        $condition = new Criteria("name", "=", "name");
        $str_condition = $condition->fromArray("[{
\"field\":{\"field\":\"email\"},
\"op\":\"=\",
\"value\":{\"value\":\"test@test.com\"}
}]");
        $this->assertEquals('[{"field":{"field":"name"},"op":"=","value":{"value":"name"}}]', $str_condition);
    }

    /**
     * @expectedException \OntraportAPI\Exceptions\ConditionOperatorException
     */
    public function testInvalidOperator()
    {
        $condition = new Criteria("name", "`_:+", "name");
    }


}

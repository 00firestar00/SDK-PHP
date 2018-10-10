<?php

use OntraportAPI\Ontraport;
use OntraportAPI\Tests\Mock\MockCurlClient;
use PHPUnit\Framework\TestCase;
use OntraportAPI\Criteria;

class CriteriaTest extends TestCase
{

    public function testBuildCondition()
    {
        $condition = new Criteria("foo", "=", "bar");
        $this->assertEquals('[{"field":{"field":"foo"},"op":"=","value":{"value":"bar"}}]', $condition->fromArray());

    }

    public function testBuildConditionWithArray()
    {
        $arr = array(
            "foo" => "bar",
            "bar" => "foo",
        );
        $condition = new Criteria("foo", "IN", $arr);
        $str_condition = $condition->fromArray();
        $this->assertEquals('[{"field":{"field":"foo"},"op":"IN","value":{"list":[{"value":"bar"},{"value":"foo"}]}}]', $condition->fromArray());
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
        $this->assertEquals('[{"field":{"field":"name"},"op":"=","value":{"value":"name"}},"AND",{"field":{"field":1},"op":"<","value":{"value":3}}]',$condition->fromArray());
    }

    public function testOrCondition()
    {
        $condition = new Criteria("name", "=", "name");
        $condition->orCondition(1, "<", 3);
        $this->assertEquals('[{"field":{"field":"name"},"op":"=","value":{"value":"name"}},"OR",{"field":{"field":1},"op":"<","value":{"value":3}}]', $condition->fromArray());
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

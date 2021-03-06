<?php

use OntraportAPI\Ontraport;
use PHPUnit\Framework\TestCase;
use OntraportAPI\Models\Rules\RuleBuilder as Builder;
use OntraportAPI\Models\Rules\Events;
use OntraportAPI\Models\Rules\Conditions;
use OntraportAPI\Models\Rules\Actions;
use OntraportAPI\ObjectType;

class ruleBuilderTest extends TestCase
{
    private $builder;

    protected function setUp(){
        $this->builder = new Builder("Building my Rule!", ObjectType::CONTACT); // object_type_id = 0;

        // Add an event if we only want the url.
        $eventParams = array(1); // parameter '1' for fulfillment id
        $this->builder->addEvent(Events::OBJECT_ADDED_TO_FULFILLMENT, $eventParams);

        // Add action
        $actionParams = array(2); // parameter '2' for task id
        $this->builder->addAction(Actions::ADD_TASK, $actionParams);

    }

    function testToRequestParams()
    {
        $requestParams = $this->builder->toRequestParams();
        $this->assertEquals('{"object_type_id":0,"name":"Building my Rule!","events":"Contact_subscribed_to_fulfillment(1)","conditions":"","actions":"Send_contact_a_task(2)"}', json_encode($requestParams));
    }

    function testAddCondition()
    {
        // Add conditions
        $conditionParams = array(1); // parameter '1' for sequence id
        $this->builder->addCondition(Conditions::OBJECT_SUBSCRIBED_SEQUENCE, $conditionParams);

        // Convert RuleBuilder object to request parameters
        $requestParams = $this->builder->toRequestParams();
        $this->assertEquals('{"object_type_id":0,"name":"Building my Rule!","events":"Contact_subscribed_to_fulfillment(1)","conditions":"Is_subscribed_to_drip(1)","actions":"Send_contact_a_task(2)"}', json_encode($requestParams));
    }

    function testAddPINGAction()
    {
        // Add conditions
        $ping_url = array("http://ontraport.com[First Name]", "some&post&data", true);
        $this->builder->addAction(Actions::PING_URL, $ping_url);

        // Convert RuleBuilder object to request parameters
        $requestParams = $this->builder->toRequestParams();
        $this->assertEquals('{"object_type_id":0,"name":"Building my Rule!","events":"Contact_subscribed_to_fulfillment(1)","conditions":"","actions":"Send_contact_a_task(2);Ping_APIURL(http:\/\/ontraport.com[First Name]::some&post&data::1)"}', json_encode($requestParams));
    }

    /**
     * @expectedException \OntraportAPI\Exceptions\OntraportAPIException
     * @expectedExceptionMessage Invalid number of parameters for rule. Refer to the API Doc to make sure you have the correct inputs.
     */
    function testAddPINGAction2()
    {
        // Add conditions
        $ping_url = array();
        $this->builder->addAction(Actions::PING_URL, $ping_url);

        // Convert RuleBuilder object to request parameters
        $requestParams = $this->builder->toRequestParams();
        $this->assertEquals('', json_encode($requestParams));
    }

    function testAddConditionAND()
    {
        // Add conditions
        $conditionParams = array(1); // parameter '1' for sequence id
        $this->builder->addCondition(Conditions::OBJECT_SUBSCRIBED_SEQUENCE, $conditionParams);

        // Add conditions
        $conditionParams = array(2); // parameter '2' for sequence id
        $this->builder->addCondition(Conditions::OBJECT_SUBSCRIBED_SEQUENCE, $conditionParams,  "AND");

        // Convert RuleBuilder object to request parameters
        $requestParams = $this->builder->toRequestParams();
        $this->assertEquals('{"object_type_id":0,"name":"Building my Rule!","events":"Contact_subscribed_to_fulfillment(1)","conditions":"Is_subscribed_to_drip(1);Is_subscribed_to_drip(2)","actions":"Send_contact_a_task(2)"}', json_encode($requestParams));
    }


    function testAddConditionOR()
    {
        // Add conditions
        $conditionParams = array(1); // parameter '1' for sequence id
        $this->builder->addCondition(Conditions::OBJECT_SUBSCRIBED_SEQUENCE, $conditionParams);

        // Add conditions
        $conditionParams = array(2); // parameter '2' for sequence id
        $this->builder->addCondition(Conditions::OBJECT_SUBSCRIBED_SEQUENCE, $conditionParams,  "OR");

        // Convert RuleBuilder object to request parameters
        $requestParams = $this->builder->toRequestParams();
        $this->assertEquals('{"object_type_id":0,"name":"Building my Rule!","events":"Contact_subscribed_to_fulfillment(1)","conditions":"Is_subscribed_to_drip(1)|Is_subscribed_to_drip(2)","actions":"Send_contact_a_task(2)"}', json_encode($requestParams));
    }

    /**
     * @expectedException \OntraportAPI\Exceptions\RequiredParamsException
     * @expectedExceptionMessage Invalid input: missing required parameter(s): operator
     */
    function testAddConditionNULL()
    {
        // Add conditions
        $conditionParams = array(1); // parameter '1' for sequence id
        $this->builder->addCondition(Conditions::OBJECT_SUBSCRIBED_SEQUENCE, $conditionParams);

        // Add conditions
        $conditionParams = array(2); // parameter '2' for sequence id
        $this->builder->addCondition(Conditions::OBJECT_SUBSCRIBED_SEQUENCE, $conditionParams);

        // Convert RuleBuilder object to request parameters
        $requestParams = $this->builder->toRequestParams();
    }

    /**
     * @expectedException \OntraportAPI\Exceptions\OntraportAPIException
     * @expectedExceptionMessage Invalid operator. Must be AND or OR.
     */
    function testAddConditionOTHER()
    {
        // Add conditions
        $conditionParams = array(1); // parameter '1' for sequence id
        $this->builder->addCondition(Conditions::OBJECT_SUBSCRIBED_SEQUENCE, $conditionParams);

        // Add conditions
        $conditionParams = array(2); // parameter '2' for sequence id
        $this->builder->addCondition(Conditions::OBJECT_SUBSCRIBED_SEQUENCE, $conditionParams, 'INVALID');


        // Convert RuleBuilder object to request parameters
        $requestParams = $this->builder->toRequestParams();
    }

    function testCreateFromResponse()
    {
        $myRule = \OntraportAPI\Models\Rules\RuleBuilder::CreateFromResponse(json_decode('{
    "name": "Create Me!",
    "events": "Contact_added_to_campaign(1)",
    "actions": "Add_contact_to_category(1)",
    "object_type_id": "0",
    "id": "1",
    "drip_id": null,
    "conditions": "Is_subscribed_to_drip(1)",
    "pause": "0",
    "last_action": "0",
    "date": "1527179185",
    "dlm": "1527179185"
}', true));
        $this->assertEquals('{"object_type_id":"0","name":"Create Me!","events":"Contact_added_to_campaign(1)","conditions":"Is_subscribed_to_drip(1)","actions":"Add_contact_to_category(1)","id":"1"}', json_encode($myRule->toRequestParams()));
    }
//
//    function testCreateFromResponse2()
//    {
//        $myRule = \OntraportAPI\Models\Rules\RuleBuilder::CreateFromResponse(json_decode('{
//    "id": "4",
//    "drip_id": null,
//    "events": "Contact_added_to_my_database();field_is_updated(1)",
//    "conditions": "Is_in_category(2)|Is_subscribed_to_productsub(1)",
//    "actions": "Add_contact_to_category(2);campaign_builder_action_change(0,1)",
//    "name": "rule2",
//    "pause": "0",
//    "last_action": "0",
//    "object_type_id": "0",
//    "date": "1539209032",
//    "dlm": "1539209072"}', true));
//        $this->assertEquals('', json_encode($myRule->toRequestParams()));
//    }

    /**
     * @expectedException \OntraportAPI\Exceptions\OntraportAPIException
     * @expectedExceptionMessage Add_to_leadrouter can only be used with Contacts object.
     */
    function testValidateRule()
    {
        $builder = new Builder("Building my Rule!", -1); // object_type_id = INVALID!
        $builder->validateRule('Actions', Actions::ADD_LEAD_ROUTER);

    }

    function dataProviderRuleType()
    {
        return array(
            array("Actions"),
            array("Conditions"),
            array("Events"),
        );
    }
    /**
     * @dataProvider dataProviderRuleType
     * @expectedException \OntraportAPI\Exceptions\OntraportAPIException
     * @expectedExceptionMessage nonsense is not a valid rule type.
     */
    function testValidateRuleAll($type)
    {
        $builder = new Builder("Building my Rule!", -1); // object_type_id = INVALID!
        $builder->validateRule($type, 'nonsense');

    }


    function testCheckRestrictedConditions()
    {
        $builder = new Builder("Building my Rule!", 0); // object_type_id = INVALID!
        $this->assertEquals(1, $builder->validateRule('Conditions', Conditions::SPENT_N_AMOUNT_ON_PRODUCT));

    }

    function testCheckRestrictedEvents()
    {
        $builder = new Builder("Building my Rule!", 0); // object_type_id = INVALID!
        $this->assertEquals(1, $builder->validateRule('Events', Events::OBJECT_PURCHASES_PRODUCT));

    }

    /**
     * @expectedException  \OntraportAPI\Exceptions\OntraportAPIException
     * @expectedExceptionMessage Events and Actions must be added to create rule.
     */
    function testClearEvents()
    {
        // Convert RuleBuilder object to request parameters
        $this->builder->clearEvents();
        $requestParams = $this->builder->toRequestParams();
    }

    /**
     * @expectedException  \OntraportAPI\Exceptions\OntraportAPIException
     * @expectedExceptionMessage Events and Actions must be added to create rule.
     */
    function testClearActions()
    {
        // Convert RuleBuilder object to request parameters
        $this->builder->clearActions();
        $requestParams = $this->builder->toRequestParams();
    }

    function testClearConditions()
    {
        // Add conditions
        $conditionParams = array(1); // parameter '1' for sequence id
        $this->builder->addCondition(Conditions::OBJECT_SUBSCRIBED_SEQUENCE, $conditionParams);

        $this->builder->clearConditions();
        // Convert RuleBuilder object to request parameters
        $requestParams = $this->builder->toRequestParams();
        $this->assertEquals('{"object_type_id":0,"name":"Building my Rule!","events":"Contact_subscribed_to_fulfillment(1)","conditions":"","actions":"Send_contact_a_task(2)"}', json_encode($requestParams));
    }

    function testRemoveConditionByName()
    {
        // Add conditions
        $conditionParams = array(1); // parameter '1' for sequence id
        $this->builder->addCondition(Conditions::OBJECT_SUBSCRIBED_SEQUENCE, $conditionParams);

        // Add conditions
        $conditionParams = array(2); // parameter '2' for sequence id
        $this->builder->addCondition(Conditions::OBJECT_SUBSCRIBED_SEQUENCE, $conditionParams,  "AND");

        // Convert RuleBuilder object to request parameters
        $this->builder->removeConditionByName('Is_subscribed_to_drip(1)');
        $requestParams = $this->builder->toRequestParams();
        $this->assertEquals('{"object_type_id":0,"name":"Building my Rule!","events":"Contact_subscribed_to_fulfillment(1)","conditions":"Is_subscribed_to_drip(2)","actions":"Send_contact_a_task(2)"}', json_encode($requestParams));
    }

    function testRemoveEventByName()
    {
        // Add an event if we only want the url.
        $eventParams = array(1); // parameter '1' for fulfillment id
        $this->builder->addEvent(Events::OBJECT_ADDED_TO_FULFILLMENT, $eventParams);


        // Convert RuleBuilder object to request parameters
        $this->builder->removeEventByName('Contact_subscribed_to_fulfillment(1)');
        $requestParams = $this->builder->toRequestParams();
        $this->assertEquals('{"object_type_id":0,"name":"Building my Rule!","events":"Contact_subscribed_to_fulfillment(1)","conditions":"","actions":"Send_contact_a_task(2)"}', json_encode($requestParams));
    }


    function testRemoveActionByName()
    {
        // Add action
        $actionParams = array(1); // parameter '2' for task id
        $this->builder->addAction(Actions::ADD_TASK, $actionParams);

        // Convert RuleBuilder object to request parameters
        $this->builder->removeActionByName('Send_contact_a_task(2)');
        $requestParams = $this->builder->toRequestParams();
        $this->assertEquals('{"object_type_id":0,"name":"Building my Rule!","events":"Contact_subscribed_to_fulfillment(1)","conditions":"","actions":"Send_contact_a_task(1)"}', json_encode($requestParams));
    }

    /**
     * @expectedException \OntraportAPI\Exceptions\OntraportAPIException
     * @expectedExceptionMessage Invalid number of parameters for rule. Refer to the API Doc to make sure you have the correct inputs.
     */
    function testCheckParamsEmptyArray()
    {
        // Add action
        $actionParams = array();
        $this->builder->addAction(Actions::ADD_TASK, $actionParams);

        // Convert RuleBuilder object to request parameters
        $this->builder->removeActionByName('Send_contact_a_task(2)');
        $requestParams = $this->builder->toRequestParams();
        $this->assertEquals('{"object_type_id":0,"name":"Building my Rule!","events":"Contact_subscribed_to_fulfillment(1)","conditions":"","actions":"Send_contact_a_task(1)"}', json_encode($requestParams));
    }

    /**
     * @expectedException \OntraportAPI\Exceptions\OntraportAPIException
     * @expectedExceptionMessage Invalid number of parameters for rule. Refer to the API Doc to make sure you have the correct inputs.
     */
    function testCheckParamsTooMany()
    {
        // Add action
        $actionParams = array(1,2,3,4);
        $this->builder->addAction(Actions::ADD_TASK, $actionParams);

        // Convert RuleBuilder object to request parameters
        $this->builder->removeActionByName('Send_contact_a_task(2)');
        $requestParams = $this->builder->toRequestParams();
        $this->assertEquals('{"object_type_id":0,"name":"Building my Rule!","events":"Contact_subscribed_to_fulfillment(1)","conditions":"","actions":"Send_contact_a_task(1)"}', json_encode($requestParams));
    }

    function testParseParamsEmptyString()
    {
        $method = new \ReflectionMethod("\OntraportAPI\Models\Rules\RuleBuilder", "_parseParams");
        $method->setAccessible(true);
        $response = $method->invoke($this->builder, 'events" => "relative_date_field()');
        $this->assertEquals("[]", json_encode($response["params"]));
    }

    public function testOperatorClassifier()
    {
        $method = new \ReflectionMethod("\OntraportAPI\Models\Rules\RuleBuilder", "_operatorClassifier");
        $method->setAccessible(true);
        $init_rule = "Classify;This|Or|That";
        $parsed_array = array(
            "or_rules" => array("This", "Or"),
            "and_rules" => array("Classify"),
            "end_rule" => array("That")
        );
        $response = $method->invoke($this->builder, $init_rule);
        $this->assertEquals($parsed_array, $response);
    }

    function paramProvider()
    {
        return array(
            array(Conditions::FIELD_HAS_VALUE),
            array(Conditions::BEEN_ON_SEQUENCE_FOR_TIMEFRAME),
            array(Conditions::OBJECT_PAUSED_RESUMED_ON_CAMPAIGN),
        );
    }

    /**
     * @dataProvider paramProvider
     *
     * @expectedException \OntraportAPI\Exceptions\OntraportAPIException
     */
    public function testCheckConditionsParams($requiredParam)
    {
        $method = new \ReflectionMethod("\OntraportAPI\Models\Rules\RuleBuilder", "_checkParams");
        $method->setAccessible(true);
        $requiredParams = Conditions::GetRequiredParams($requiredParam);
        $requestParams = Conditions::GetRequiredParams($requiredParam);
        $response = $method->invoke($this->builder, $requiredParams, $requestParams);
//        $this->assertEquals($parsed_array, $response);
    }

    /**
     *
     * @expectedException \OntraportAPI\Exceptions\OntraportAPIException
     */
    public function testCheckEventsParams()
    {
        $method = new \ReflectionMethod("\OntraportAPI\Models\Rules\RuleBuilder", "_checkParams");
        $method->setAccessible(true);
        $requiredParams = Events::GetRequiredParams(Events::OBJECT_SUBMITS_FORM);
        $requestParams = Events::GetRequiredParams(Events::OBJECT_SUBMITS_FORM);
        $response = $method->invoke($this->builder, $requiredParams, $requestParams);
    }

}

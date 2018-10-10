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

}

<?php

use OntraportAPI\Ontraport;
use PHPUnit\Framework\TestCase;
use OntraportAPI\Models\Rules\RuleBuilder as Builder;
use OntraportAPI\Models\Rules\Events;
use OntraportAPI\Models\Rules\Conditions;
use OntraportAPI\Models\Rules\Actions;
use OntraportAPI\ObjectType;

class testRuleBuilder extends TestCase
{
    function testToRequestParams()
    {
        $builder = new Builder("Building my Rule!", ObjectType::CONTACT); // object_type_id = 0;

        // Add an event if we only want the url.
        $eventParams = array(1); // parameter '1' for fulfillment id
        $builder->addEvent(Events::OBJECT_ADDED_TO_FULFILLMENT, $eventParams);

        // Add action
        $actionParams = array(2); // parameter '2' for task id
        $builder->addAction(Actions::ADD_TASK, $actionParams);

        // Convert RuleBuilder object to request parameters
        $requestParams = $builder->toRequestParams();
        $this->assertEquals('{"object_type_id":0,"name":"Building my Rule!","events":"Contact_subscribed_to_fulfillment(1)","conditions":"","actions":"Send_contact_a_task(2)"}', json_encode($requestParams));
    }

    function testAddCondition()
    {
        $builder = new Builder("Building my Rule!", ObjectType::CONTACT); // object_type_id = 0;

        // Add an event if we only want the url.
        $eventParams = array(1); // parameter '1' for fulfillment id
        $builder->addEvent(Events::OBJECT_ADDED_TO_FULFILLMENT, $eventParams);

        // Add conditions
        $conditionParams = array(1); // parameter '1' for sequence id
        $builder->addCondition(Conditions::OBJECT_SUBSCRIBED_SEQUENCE, $conditionParams);

        // Add action
        $actionParams = array(2); // parameter '2' for task id
        $builder->addAction(Actions::ADD_TASK, $actionParams);

        // Convert RuleBuilder object to request parameters
        $requestParams = $builder->toRequestParams();
        $this->assertEquals('{"object_type_id":0,"name":"Building my Rule!","events":"Contact_subscribed_to_fulfillment(1)","conditions":"Is_subscribed_to_drip(1)","actions":"Send_contact_a_task(2)"}', json_encode($requestParams));
    }

    function testCreateFromResponse()
    {
        $myRule = new \OntraportAPI\Models\Rules\RuleBuilder('blank',0);
        $myRule = \OntraportAPI\Models\Rules\RuleBuilder::CreateFromResponse(json_decode('{
    "name": "Create Me!",
    "events": "Contact_added_to_campaign(1)",
    "actions": "Add_contact_to_category(1)",
    "object_type_id": "0",
    "id": "1",
    "drip_id": null,
    "conditions": "",
    "pause": "0",
    "last_action": "0",
    "date": "1527179185",
    "dlm": "1527179185"
}', true));
        $this->assertEquals('{"object_type_id":"0","name":"Create Me!","events":"Contact_added_to_campaign(1)","conditions":"","actions":"Add_contact_to_category(1)","id":"1"}', json_encode($myRule->toRequestParams()));
    }

}

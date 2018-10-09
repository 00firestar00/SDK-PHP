<?php

use OntraportAPI\Ontraport;
use PHPUnit\Framework\TestCase;
use OntraportAPI\Models\Rules\RuleBuilder as Builder;
use OntraportAPI\Models\Rules\Events;
use OntraportAPI\Models\Rules\Conditions;
use OntraportAPI\Models\Rules\Actions;

class testRuleBuilder extends TestCase
{
    function testToRequestParams()
    {
        $builder = new Builder("Building my Rule!", \OntraportAPI\ObjectType::CONTACT); // object_type_id = 0;

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
}

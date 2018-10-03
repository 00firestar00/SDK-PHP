<?php


namespace OntraportAPI\tests\Mock;

use OntraportAPI\CurlClient;
use OntraportAPI\Ontraport as O;

class MockCurlClient extends CurlClient
{


    public function httpRequest($requestParams, $url, $method, $requiredParams, $options)
    {
        $API_BASE = O::REQUEST_URL . '/' . O::API_VERSION . '/';

        if($this->str_contains($url, 'Contact') or $this->str_contains($url, 'object')) {
            if (($url === $API_BASE . 'Contact' or $url === $API_BASE . 'object') and $method === 'get') {
                return $this->getSingle('contact');
            } elseif (($url === $API_BASE . 'Contact' or $url === $API_BASE . 'object') and $method === 'delete') {
                return $this->deleteSingleContact();
            } elseif (($url === $API_BASE . 'Contacts/getInfo'or $url === $API_BASE . 'objects/getInfo')) {
                return $this->getInfo('contact');
            } elseif (($url === $API_BASE . 'Contacts' or $url === $API_BASE . 'objects') and $method === 'get') {
                return $this->getMultiple('contacts');
            } elseif (($url === $API_BASE . 'Contacts' or $url === $API_BASE . 'objects') and $method === 'delete') {
                return $this->deleteMultipleContacts();
            } elseif (($url === $API_BASE . 'Contacts' or $url === $API_BASE . 'objects') and $method === 'post') {
                return $this->create('contact');
            } elseif (($url === $API_BASE . 'Contacts' or $url === $API_BASE . 'objects') and $method === 'put') {
                return $this->update('contact');
            } elseif ($url === $API_BASE . 'Contacts/meta' or $url === $API_BASE . 'objects/meta') {
                return $this->getMeta('contact');
            } elseif ($url === $API_BASE . 'Contacts/saveorupdate' or $url === $API_BASE . 'objects/saveorupdate') {
                return $this->saveOrUpdateContact();
            } elseif (($url === $API_BASE . 'Contacts/fieldeditor' or $url === $API_BASE . 'objects/fieldeditor') and $method === 'get') {
                return $this->retrieveFields();
            } elseif (($url === $API_BASE . 'Contacts/fieldeditor' or $url === $API_BASE . 'objects/fieldeditor') and $method === 'post') {
                return $this->createFields();
            } elseif (($url === $API_BASE . 'Contacts/fieldeditor' or $url === $API_BASE . 'objects/fieldeditor') and $method === 'put') {
                return $this->updateFields();
            } elseif (($url === $API_BASE . 'Contacts/fieldeditor' or $url === $API_BASE . 'objects/fieldeditor') and $method === 'delete') {
                return $this->deleteFields();
            }

            //Applicable to Objects but not contacts
            elseif ($url === $API_BASE . 'objects/tagByName' and $method === 'put') {
                return $this->tagObjectByName();
            } elseif ($url === $API_BASE . 'objects/tagByName' and $method === 'delete') {
                return $this->removeTagByName();
            } elseif ($url === $API_BASE . 'object/getByEmail' and $method === 'get') {
                return $this->getObjectByEmail();
            } elseif ($url === $API_BASE . 'objects/tag' and $method === 'get') {
                return $this->getObjectsWithTag();
            } elseif ($url === $API_BASE . 'objects/pause'){
                return $this->pause();
            } elseif ($url === $API_BASE . 'objects/unpause'){
                return $this->unpause();
            } elseif ($url === $API_BASE . 'objects/sequence' and $method === 'put'){
                return $this->addToSequence();
            } elseif ($url === $API_BASE . 'objects/sequence' and $method === 'delete'){
                return $this->removeFromSequence();
            } elseif ($url === $API_BASE . 'objects/subscribe' and $method === 'put'){
                return $this->subscribe();
            } elseif ($url === $API_BASE . 'objects/subscribe' and $method === 'delete'){
                return $this->unsubscribe();
            } elseif ($url === $API_BASE . 'objects/tag' and $method === 'put'){
                return $this->addTag();
            } elseif ($url === $API_BASE . 'objects/tag' and $method === 'delete'){
                return $this->removeTag();
            }

        } elseif($this->str_contains(strtolower($url), 'task')) {
            if ($url === $API_BASE . 'task/assign') {
                return $this->assignTask();
            } elseif ($url === $API_BASE . 'task/reschedule') {
                return $this->rescheduleTask();
            } elseif ($url === $API_BASE . 'task/cancel') {
                return $this->cancelTask();
            } elseif ($url === $API_BASE . 'task/complete') {
                return $this->completeTask();
            } elseif ($url === $API_BASE . 'Task' and $method === 'get') {
                return $this->getSingle('task');
            } elseif ($url === $API_BASE . 'Tasks' and $method === 'get') {
                return $this->getMultiple('tasks');
            } elseif ($url === $API_BASE . 'Tasks/getInfo') {
                return $this->getInfo('task');
            } elseif ($url === $API_BASE . 'Tasks/meta') {
                return $this->getMeta('task');
            } elseif ($url === $API_BASE . 'Tasks' and $method === 'put') {
                return $this->update('task');
            }
        } elseif($this->str_contains(strtolower($url), 'message')) {
            if ($url === $API_BASE . 'Message' and $method === 'get') {
                return $this->getSingle('message');
            } elseif ($url === $API_BASE . 'Messages' and $method === 'get') {
                return $this->getMultiple('messages');
            } elseif ($url === $API_BASE . 'Messages/getInfo') {
                return $this->getInfo('message');
            } elseif ($url === $API_BASE . 'Messages/meta') {
                return $this->getMeta('message');
            } elseif ($url === $API_BASE . 'message' and $method === 'post') {
                return $this->create('message');
            } elseif ($url === $API_BASE . 'message' and $method === 'put') {
                return $this->update('message');
            }
        }


        return parent::httpRequest($requestParams, $url, $method, $requiredParams, $options);
    }

    function str_contains($haystack, $needle)
    {
        return strpos($haystack, $needle) !== false;
    }

    function getSingle($objectTypeToGet)
    {
        if($objectTypeToGet === 'contact')
        {
            return "{
  \"code\": 0,
  \"data\": {
    \"id\": \"1\",
    \"owner\": \"1\",
    \"firstname\": \"unit\",
    \"lastname\": \"test\"
  },
  \"account_id\": 50
}";
        } elseif($objectTypeToGet === 'message')
        {
            return '{
  "code": 0,
  "data": {
    "id": "5",
    "alias": "task_title",
    "tags": "",
  },
  "account_id": 187157
}';
        } elseif($objectTypeToGet === 'task')
        {
            return '{
  "code": 0,
  "data": {
    "id": "1",
    "owner": "1",
    "drip_id": "0",
    "contact_id": "2",
    "step_num": "0",
    "subject": "task_subject_here",
    "date_assigned": "1538513596",
    "date_due": "1538859196",
    "date_complete": null,
    "status": "0",
    "type": "0",
    "details": "task instructions go here!",
    "hidden": "0",
    "call_outcome_id": "0",
    "item_id": "5",
    "notifications": null,
    "rules": null,
    "object_type_id": "0",
    "object_name": "Contacts"
  },
  "account_id": 187157
}';
        }
        return 'Error: Unexpected object type as argument!';
    }

    function getInfo($objectType)
    {
        if($objectType === 'contact') {
            return "{\"code\": 0,
                      \"data\": {
                        \"listFields\": [
                          \"fn\",
                          \"email\",
                          \"office_phone\",
                          \"date\",
                          \"grade\",
                          \"dla\",
                          \"contact_id\"
                        ],
                        \"listFieldSettings\": [],
                        \"cardViewSettings\": [],
                        \"viewMode\": [],
                        \"count\": \"2\"
                      },
                      \"account_id\": 50
                    }";
        } elseif($objectType === 'message'){
            return  '{
  "code": 0,
  "data": {
    "listFields": [
      "name",
      "subject",
      "spam_score",
      "date",
      "type",
      "mcsent",
      "mcopened",
      "mcclicked",
      "mcnotopened",
      "mcnotclicked",
      "mcunsub",
      "mcabuse",
      "dlm"
    ],
    "listFieldSettings": [],
    "cardViewSettings": [],
    "viewMode": [],
    "count": "5"
  },
  "account_id": 187157
}';
        } elseif ($objectType === 'task'){
            return '{
  "code": 0,
  "data": {
    "listFields": [
      "",
      "owner",
      "subject",
      "status",
      "date_assigned",
      "date_due",
      "date_complete",
      "call_outcome_id",
      "contact_id"
    ],
    "listFieldSettings": [],
    "cardViewSettings": [],
    "viewMode": [],
    "count": "3"
  },
  "account_id": 187157
}';
        }
        return 'Error: Unexpected object type as argument!';
    }

    function getMultiple($objectTypeToGet)
    {
        if($objectTypeToGet === 'contacts')
        {
            return '{
  "code": 0,
  "data": [
    {
      "id": "8",
      "owner": "1",
      "firstname": "unitUpdated",
      "lastname": "test"
    },
    {
      "id": "10",
      "owner": "1",
      "firstname": "unit",
      "lastname": "test"
    }
  ],
  "account_id": 50,
  "misc": []
}';
        } elseif($objectTypeToGet === 'messages')
        {
            return '{
  "code": 0,
  "data": [
    {
      "id": "1",
      "alias": "test1",
      "type": "Template",
      "last_save": "1537912999"
    },
    {
      "id": "2",
      "alias": "Abandoned Cart: Did we lose you?",
      "type": "Template",
      "last_save": "1496332432"
    }
  ],
  "account_id": 187157,
  "misc": []
}';
        } elseif($objectTypeToGet === 'tasks'){
            return '{
  "code": 0,
  "data": [
    {
      "id": "1",
      "owner": "1",
      "drip_id": "0"
    },
    {
      "id": "2",
      "owner": "1",
      "drip_id": "0"
    }
  ],
  "account_id": 187157,
  "misc": []
}';
        }
        return('Error: Unexpected object type as argument!');
    }

    function deleteSingleContact()
    {
        return '{
  "code": 0,
  "account_id": 50
}';
    }

    function deleteMultipleContacts()
    {
        return '{
  "code": 0,
  "data": "Deleted",
  "account_id": 50
}';
    }

    function create($objectType)
    {
        if($objectType === 'contact')
        {
            return '{
  "code": 0,
  "data": {
    "firstname": "unit",
    "lastname": "test",
    "use_utm_names": "false",
    "id": "8",
    "owner": "1",
  },
  "account_id": 50
}';
        } elseif($objectType === 'message')
        {
            return '{
  "code": 0,
  "data": {
    "id": 7,
    "date": "1538590526"
  },
  "account_id": 187157
}';
        }
        return('Error: Unexpected object type as argument!');
    }

    function update($objectType)
    {
        if ($objectType === 'contact') {
            return '{
  "code": 0,
  "data": {
    "attrs": {
      "firstname": "unitUpdated",
      "dlm": "1538154601",
      "id": "8"
    }
  },
  "account_id": 50
}';
        } elseif($objectType === 'message'){
            return '{
  "code": 0,
  "data": {
    "id": "7",
    "date": "1538590526"
  },
  "account_id": 187157
}';
        } elseif($objectType === 'task'){
            return '{
  "code": 0,
  "data": {
    "attrs": {
      "date_due": "4",
      "id": "1"
    }
  },
  "account_id": 187157
}';
        }
        return('Error: Unexpected object type as argument!');
    }

    function getMeta($objectType)
    {
        if ($objectType === 'contact') {
            return '{
  "code": 0,
  "data": {
    "0": {
      "name": "Contact",
      "fields": {
        "firstname": {
          "alias": "First Name",
          "type": "text",
          "required": "0",
          "unique": "0",
          "editable": "1",
          "deletable": "0"
        },
        "lastname": {
          "alias": "Last Name",
          "type": "text",
          "required": "0",
          "unique": "0",
          "editable": "1",
          "deletable": "0"
        },
        "email": {
          "alias": "Email",
          "type": "email",
          "required": "0",
          "unique": "0",
          "editable": "1",
          "deletable": "0"
        }
      }
    }
  },
  "account_id": 50
}';
        }
        elseif($objectType === 'message')
        {
            return '{
  "code": 0,
  "data": {
    "7": {
      "name": "Message",
      "fields": {
        "alias": {
          "alias": "Name",
          "type": "text",
          "required": "0",
          "unique": "0",
          "editable": "1",
          "deletable": "0"
        },
        "name": {
          "alias": "Name",
          "type": "mergefield",
          "required": "0",
          "unique": "0",
          "editable": 0,
          "deletable": "1"
        },
        "subject": {
          "alias": "Subject",
          "type": "text",
          "required": "0",
          "unique": "0",
          "editable": 1,
          "deletable": "1"
        }
      }
    }
  },
  "account_id": 187157
}';
        }elseif($objectType === 'task'){
            return '{
  "code": 0,
  "data": {
    "1": {
      "name": "Task",
      "fields": {
        "owner": {
          "alias": "Assignee",
          "type": "parent",
          "required": "0",
          "unique": "0",
          "editable": "1",
          "deletable": "1",
          "parent_object": 2
        },
        "contact_id": {
          "alias": "Contact",
          "type": "parent",
          "required": "0",
          "unique": "0",
          "editable": "0",
          "deletable": "1"
        }
      }
    }
  },
  "account_id": 187157
}';
        }
        return('Error: Unexpected object type as argument!');
    }
    function saveOrUpdateContact()
    {
        return '{
  "code": 0,
  "data": {
    "use_utm_names": "false",
    "firstname": "unitUpdated",
    "lastname": "updatedLastName",
    "id": "9",
    "owner": "1",
  },
  "account_id": 50
}';
    }

    function retrieveFields()
    {
        return '{
  "code": 0,
  "data": {
    "1": {
      "id": 1,
      "name": "Contact Information",
      "description": null,
      "fields": [
        [
          {
            "id": 198,
            "alias": "Name",
            "field": "fn",
            "type": "mergefield",
            "required": 0,
            "unique": 0,
            "editable": 0,
            "deletable": 0,
            "options": "<op:merge field=\'firstname\'>X</op:merge> <op:merge field=\'lastname\'>X</op:merge>"
          },
          {
            "id": 1,
            "alias": "First Name",
            "field": "firstname",
            "type": "text",
            "required": 0,
            "unique": 0,
            "editable": 1,
            "deletable": 0,
            "options": ""
          }
        ]
      ]
    }
  },
  "account_id": 50
}';
    }

    function createFields()
    {
        return '{
  "code": 0,
  "data": {
    "success": {
      "f1557": "string"
    },
    "error": []
  },
  "account_id": 50
}';

    }

    function updateFields()
    {
        return '{
  "code": 0,
  "data": {
    "success": {
      "f1557": "string",
      "description": "string2"
    }
  },
  "account_id": 50
}';
    }

    function deleteFields()
    {
        return '{
  "code": 0,
  "data": "Deleted",
  "account_id": 50
}';
    }

    function getObjectByEmail()
    {
        return '{
  "code": 0,
  "data": {
    "id": "10"
  },
  "account_id": 50
}';
    }

    function tagObjectByName()
    {
        return '{
  "code": 0,
  "data": "The tag is now being processed.",
  "account_id": 187157
}';
    }

    function getObjectsWithTag(){
        return '{
  "code": 0,
  "data": [
    {
      "id": "10",
      "owner": "1",
      "firstname": "unit",
      "lastname": "test",
    }
  ],
  "account_id": 50
}';
    }

    function pause()
    {
        return '{
  "code": 0,
  "account_id": 187157
}';
    }

    function unpause()
    {
        return '{
  "code": 0,
  "account_id": 187157
}';
    }

    function addToSequence()
    {
        return '{
  "code": 0,
  "data": "The subscription is now being processed.",
  "account_id": 187157
}';
    }

    function removeFromSequence()
    {
        return '{
  "code": 0,
  "data": "The subscription is now being processed.",
  "account_id": 187157
}';
    }

    function subscribe()
    {
        return '{
  "code": 0,
  "data": "The subscription is now being processed.",
  "account_id": 187157
}';
    }

    function unsubscribe()
    {
        return '{
  "code": 0,
  "data": "The subscription is now being processed.",
  "account_id": 187157
}';
    }

    function addTag()
    {
        return '{
  "code": 0,
  "data": "The tag is now being processed.",
  "account_id": 187157
}';
    }

    function removeTag()
    {
        return '{
  "code": 0,
  "data": "The tag is now being processed.",
  "account_id": 187157
}';
    }

    function addTagByName()
    {
        return '{
  "code": 0,
  "data": "The tag is now being processed.",
  "account_id": 187157
}';
    }

    function removeTagByName()
    {
        return '{
  "code": 0,
  "data": "The tag is now being processed.",
  "account_id": 187157
}';
    }

    function assignTask()
    {
        return '{
  "code": 0,
  "account_id": 187157
}';
    }

    function rescheduleTask()
    {
        return '{
  "code": 0,
  "account_id": 187157
}';
    }

    function cancelTask()
    {
        return '{
  "code": 0,
  "account_id": 187157
}';
    }

    function completeTask()
    {
        return '{
  "code": 0,
  "account_id": 187157
}';
    }



}

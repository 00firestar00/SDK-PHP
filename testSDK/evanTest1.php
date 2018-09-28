<?php
// ONTRAPORT SDK
require_once('../src/Ontraport.php');

use OntraportAPI\CurlClient;
use OntraportAPI\ObjectType;
use OntraportAPI\Ontraport;
use OntraportAPI\Rules;
use OntraportAPI\RulesType;

// Account's API credentials
$api_id = "2_187157_HvW8bB1i1";
$api_key = "Jc4fHACKVw6rTLM";

// Instantiate Ontraport
$ontraport = new Ontraport($api_id, $api_key);

// ObjectID
$requestParams = array(
    "id" => 1
);

$response = $ontraport->contact()->retrieveSingle($requestParams);
$response = json_decode($response, true);
var_dump($response["data"]);

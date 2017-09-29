<?php

namespace Mock;

class MockClient extends \ONTRAPORTAPI\CurlClient
{
    public function httpRequest($requestParams, $url, $method, $requiredParams, $options)
    {
        if (!$this->_validateRequest($requestParams, $requiredParams, $method))
        {
            return false;
        }

        if ($options && is_array($options))
        {
            if (array_key_exists("headers", $options))
            {
                foreach ($options["headers"] as $header => $value)
                {
                    $this->_setRequestHeader($header, $value);
                }
            }
        }

        if (array_key_exists("Content-Type", $this->_requestHeaders) && $this->_requestHeaders["Content-Type"] == "Content-Type: application/json")
        {
            $requestParams = json_encode($requestParams);
        }

        if (is_array($requestParams))
        {
            $requestParams = http_build_query($requestParams);
        }

        // TODO: Do something other than CURL to get the mock data

        return true;
    }
}

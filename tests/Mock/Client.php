<?php

namespace Mock;

class MockClient extends CurlClient
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

        $curlHandle = curl_init();

        switch(strtolower($method))
        {
            case "post":
                curl_setopt($curlHandle, CURLOPT_POST, 1);
                curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $requestParams);
                break;

            case "get":
                curl_setopt($curlHandle, CURLOPT_HTTPGET, 1);
                $url = $url."?".$requestParams;
                break;

            case "put":
                curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $requestParams);
                break;

            case "delete":
                curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, "DELETE");
                if ($this->_requestHeaders["Content-Type"] == "Content-Type: application/json")
                {
                    curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $requestParams);
                }
                else
                {
                    $url = $url."?".$requestParams;
                }
                break;
        }

        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_HTTPHEADER, $this->_requestHeaders);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 60);

        $result = curl_exec($curlHandle);
        curl_close($curlHandle);

        unset($this->_requestHeaders["Content-Type"]);

        return $result;
    }
}

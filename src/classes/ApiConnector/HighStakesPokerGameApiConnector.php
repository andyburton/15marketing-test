<?php

namespace ApiConnector;

use ApiRequest\HttpApiRequest;
use ApiResponse\ApiResponse;

/**
 * Class HighStakesPokerGameApiConnector
 *
 * Game API Connector extended to provide communication with the HighStakesPokerGame API
 * which has different connection parameters to the BingoBongo Game
 */
class HighStakesPokerGameApiConnector extends ApiConnector
{
    private $url, $accessKey;

    /**
     * Setup required params for our Game API
     * @param string $url
     * @param string $accessKey
     * @param ApiResponse $responseHandler
     */
    public function __construct(string $url, string $accessKey, ApiResponse $responseHandler)
    {
        parent::__construct($responseHandler);
        $this->url = $url;
        $this->accessKey = $accessKey;
    }

    /**
     * Create a new API request to the HighStakesPokerGame API URL with an access key
     * @param string $endpoint API endpoint
     * @param int $method HTTP method
     * @return HttpApiRequest
     */
    public function getRequest(string $endpoint, int $method): HttpApiRequest
    {
        $request = parent::getRequest($this->url . $endpoint, $method);
        $request->addPostFields(['access_key' => $this->accessKey]);
        return $request;
    }

}
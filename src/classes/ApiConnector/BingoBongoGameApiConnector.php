<?php

namespace ApiConnector;

use ApiRequest\HttpApiRequest;
use ApiResponse\ApiResponse;

/**
 * Class BingoBongoGameApiConnector
 *
 * Game API Connector extended to provide communication with the BingoBongo Game API
 * which has different connection parameters to the HighStakesPoker Game
 */
class BingoBongoGameApiConnector extends ApiConnector
{
    private $url, $key, $platform;

    /**
     * Setup required params for our Game API
     * @param string $url
     * @param string $key
     * @param string $platform
     * @param ApiResponse $responseHandler
     */
    public function __construct(string $url, string $key, string $platform, ApiResponse $responseHandler)
    {
        parent::__construct($responseHandler);
        $this->url = $url;
        $this->key = $key;
        $this->platform = $platform;
    }

    /**
     * Create a new API request to the BingoBongo API URL with a game key and platform
     * @param string $endpoint API endpoint
     * @param int $method HTTP method
     * @return HttpApiRequest
     */
    public function getRequest(string $endpoint, int $method): HttpApiRequest
    {
        $request = parent::getRequest($this->url . $endpoint, $method);
        $request->addPostFields(['key' => $this->key, 'platform' => $this->platform]);
        return $request;
    }

}
<?php

namespace ApiConnector;

use ApiRequest\ApiRequestException;
use ApiRequest\HttpApiRequest;
use ApiResponse\ApiResponse;

/**
 * Class ApiConnector
 *
 * Abstract Game API Connector to handle endpoint communication with a Game API
 *
 * This allows us to handle different games with different APIs and responses
 */
abstract class ApiConnector
{

    protected $responseHandler;

    /**
     * ApiConnector constructor.
     * @param ApiResponse $responseHandler
     */
    public function __construct(ApiResponse $responseHandler)
    {
        $this->responseHandler = $responseHandler;
    }

    /**
     * Return a HttpRequest object to make our API request
     * @param string $url
     * @param int $method
     * @return HttpApiRequest
     */
    public function getRequest(string $url, int $method): HttpApiRequest
    {
        return new HttpApiRequest($this->responseHandler, $url, $method);
    }

    /**
     * Make an API request and return an object with the response
     * @param HttpApiRequest $request
     * @return object
     */
    public function makeRequest(HttpApiRequest $request): object
    {
        try {
            $response = $request->send();
            return $response->getData();
        } catch (ApiRequestException $e) {
            // Do something with exception
        }
    }
}
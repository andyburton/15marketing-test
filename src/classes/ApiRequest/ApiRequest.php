<?php

namespace ApiRequest;

use ApiResponse\ApiResponse;

/**
 * Class ApiRequest
 *
 * Abstract base class for a Game API Request
 *
 * This allows us to handle different type of API requests e.g. HTTP, SOAP
 */
abstract class ApiRequest
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
     * Send an API request
     * @return ApiResponse
     */
    abstract public function send(): ApiResponse;
}
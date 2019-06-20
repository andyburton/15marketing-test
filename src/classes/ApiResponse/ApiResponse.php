<?php

namespace ApiResponse;

/**
 * Class ApiResponse
 *
 * Abstract base class for a Game API Response
 *
 * This allows us to handle different type of API responses e.g. XmlApiResponse, JsonApiResponse...
 * but with a response in a standardised format for the rest of our app to handle
 */
abstract class ApiResponse
{

    protected $data;

    /**
     * Parse a request response and return new ApiResponse object of the same type
     * @param string $data
     * @return ApiResponse
     */
    static function parseResponse(string $data): ApiResponse
    {
        $obj = new static;
        $obj->setData($data);
        return $obj;
    }

    /**
     * Set data for the response
     * @param string $data
     */
    protected function setData(string $data):void {
        $this->data = $data;
    }

    /**
     * Return response data object
     * @return object
     */
    abstract public function getData(): object;
}
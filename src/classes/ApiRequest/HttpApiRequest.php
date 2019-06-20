<?php

namespace ApiRequest;

use ApiResponse\ApiResponse;

/**
 * Class HttpApiRequest
 *
 * HTTP request for our Game API
 */
class HttpApiRequest extends ApiRequest
{

    const METHOD_GET = 1;
    const METHOD_POST = 2;
    const METHOD_PUT = 3;
    const METHOD_DELETE = 4;

    private $url, $method, $headers = [], $queryData = [], $postFields = [];

    public function __construct(ApiResponse $responseHandler, string $url, int $method = self::METHOD_GET)
    {
        parent::__construct($responseHandler);
        $this->url = $url;
        $this->method = $method;
    }

    public function addHeaders(array $headers): void
    {
        $this->headers = array_merge($this->headers, $headers);
    }

    public function addQueryData(array $queryData): void
    {
        $this->queryData = array_merge($this->queryData, $queryData);
    }

    public function addPostFields(array $postFields): void
    {
        $this->postFields = array_merge($this->postFields, $postFields);
    }

    public function getRequestBody(): string {
        // Nice and easy to mock
        return '';
    }

    public function send(): ApiResponse
    {

        /**
         * @todo
         * Format request and send then pass to ApiResponse
         * using Guzzle or similar for HTTP... for now this allows init to run.
         */
        // $request = ...
        $response = $this->responseHandler::parseResponse($this->getRequestBody());

        echo "send HttpApiRequest to {$this->url}\n";
        echo "headers: " . print_r($this->headers, true);
        echo "postFields: " . print_r($this->postFields, true);
        echo "queryData: " . print_r($this->queryData, true);
        echo "response: " . print_r($response->getData(), true);
        echo "\n\n";

        return $response;
    }
}
<?php

use ApiConnector\ApiConnector;
use ApiRequest\HttpApiRequest;

/**
 * Class AbstractGame
 *
 * Abstract base class to communicate with a Game
 *
 * This allows us to have multiple and different games with the same methods / endpoints
 * but which can have different API connectors and parameters, request and response formats
 */
abstract class Game
{

    /**
     * Cache our ApiConnector
     * @var ApiConnector
     */
    private $apiConnector;

    /**
     * Return a ApiConnector to handle API communication with our Game
     * @return ApiConnector
     */
    abstract public function getGameConnector(): ApiConnector;

    /**
     * Generate a unique session ID
     * @return string
     */
    protected function getUniqueSessionId(): string
    {
        return uniqid();
    }

    /**
     * Return our API to use for communication and keep cached
     * @return ApiConnector
     */
    protected function api(): ApiConnector {
        if (!$this->apiConnector) {
            $this->apiConnector = $this->getGameConnector();
        }
        return $this->apiConnector;
    }

    /**
     * Get a new request to our API Connector and set a unique session id
     * @param string $endpoint
     * @param int $method
     * @return HttpApiRequest
     */
    protected function getRequest(string $endpoint, $method = HttpApiRequest::METHOD_GET): HttpApiRequest
    {
        // Generate API request
        $request = $this->api()->getRequest($endpoint, $method);

        // Add a unique session ID to each request
        $request->addHeaders(['x-session-id' => $this->getUniqueSessionId()]);

        return $request;
    }

    /**
     * Initialise game
     * @param array $params Post parameters
     * @return object
     */
    public function init(array $params = []): object
    {
        echo 'Call ' . __FUNCTION__ . ' for ' . static::class . "\n";
        $request = $this->getRequest('/init', HttpApiRequest::METHOD_POST);
        $request->addPostFields($params);
        return $this->api()->makeRequest($request);
    }

    /**
     * Get balance for a user
     * @param string $userId
     * @return object
     */
    public function balance(string $userId): object
    {
        echo 'Call ' . __FUNCTION__ . ' for ' . static::class . "\n";
        $request = $this->getRequest('/getbalance');
        $request->addQueryData(['user_id' => $userId]);
        return $this->api()->makeRequest($request);
    }

    /**
     * Make a bet for a user
     * @param string $userId
     * @return object
     */
    public function bet(string $userId): object
    {
        echo 'Call ' . __FUNCTION__ . ' for ' . static::class . "\n";
        $request = $this->getRequest('/roundbetwin');
        $request->addQueryData(['user_id' => $userId]);
        return $this->api()->makeRequest($request);
    }

    /**
     * Logout a user
     * @param string $userId
     * @return object
     */
    public function logout(string $userId): object
    {
        echo 'Call ' . __FUNCTION__ . ' for ' . static::class . "\n";
        $request = $this->getRequest('/logout');
        $request->addQueryData(['user_id' => $userId]);
        return $this->api()->makeRequest($request);
    }
}
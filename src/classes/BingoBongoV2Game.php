<?php

use ApiConnector\ApiConnector;
use ApiConnector\BingoBongoGameApiConnector;
use ApiResponse\JsonApiResponse;

/**
 * Class BingoBongoV2Game
 *
 * Implementation of a BingoBongo Version 2 Game with JsonApiResponse response
 */
class BingoBongoV2Game extends Game
{
    private $url, $key, $platform;

    /**
     * Setup required params for our Game API
     * @param string $key
     * @param string $platform
     */
    public function __construct(string $key, string $platform)
    {
        $this->url = 'https://my.bingobongo-v2.game';
        $this->key = $key;
        $this->platform = $platform;
    }

    /**
     * Use BingoBongoGameApiConnector for our BingoBongoV2Game with JsonApiResponse response
     * @return ApiConnector
     */
    public function getGameConnector(): ApiConnector
    {
        return new BingoBongoGameApiConnector($this->url, $this->key, $this->platform, new JsonApiResponse);
    }

    /**
     * Lets ensure our game generates a unique id with the game label
     * @return string
     */
    protected function getUniqueSessionId(): string
    {
        return uniqid('bingobongo_v2_');
    }

}
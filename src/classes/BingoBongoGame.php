<?php

use ApiConnector\ApiConnector;
use ApiConnector\BingoBongoGameApiConnector;
use ApiResponse\XmlApiResponse;

/**
 * Class BingoBongoGame
 *
 * Implementation of a BingoBongo Game with XmlApiResponse responses
 */
class BingoBongoGame extends Game
{
    private $url, $key, $platform;

    /**
     * Setup required params for our Game API
     * @param string $key
     * @param string $platform
     */
    public function __construct(string $key, string $platform)
    {
        $this->url = 'https://my.bingobongo.game';
        $this->key = $key;
        $this->platform = $platform;
    }

    /**
     * Use BingoBongoGameApiConnector for our BingoBongoGame with XmlApiResponse response
     * @return ApiConnector
     */
    public function getGameConnector(): ApiConnector
    {
        return new BingoBongoGameApiConnector($this->url, $this->key, $this->platform, new XmlApiResponse);
    }

    /**
     * Lets ensure our game generates a unique id with the game label
     * @return string
     */
    public function getUniqueSessionId(): string
    {
        return uniqid('bingobongo_');
    }

}
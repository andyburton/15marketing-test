<?php

use ApiConnector\ApiConnector;
use ApiConnector\HighStakesPokerGameApiConnector;
use ApiResponse\JsonApiResponse;

/**
 * Class HighStakesPokerGame
 *
 * Implementation of a HighStakesPoker Game with a JsonApiResponse response
 */
class HighStakesPokerGame extends Game
{
    private $url, $accessKey;

    /**
     * Setup required params for our Game API
     * @param string $accessKey
     */
    public function __construct(string $accessKey)
    {
        $this->url = 'https://my.highstakespoker.game';
        $this->accessKey = $accessKey;
    }

    /**
     * Use HighStakesPokerGameApiConnector for our HighStakesPokerGame with JsonApiResponse response
     * @return ApiConnector
     */
    public function getGameConnector(): ApiConnector
    {
        return new HighStakesPokerGameApiConnector($this->url, $this->accessKey, new JsonApiResponse);
    }

}
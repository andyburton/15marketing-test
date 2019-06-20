<?php

declare(strict_types=1);

use ApiConnector\BingoBongoGameApiConnector;
use ApiRequest\HttpApiRequest;
use ApiResponse\XmlApiResponse;
use PHPUnit\Framework\TestCase;

final class BingoBongoGameTest extends TestCase
{

    public function initGame()
    {
        return new BingoBongoGame('key', 'platform');
    }

    public function test_BingoBongoGame_Is_Instantiated(): void
    {
        $game = $this->initGame();
        $this->assertInstanceOf(
            BingoBongoGame::class,
            $game
        );
    }

    public function test_getGameConnector_Returns_BingoBongoGameApiConnector(): void
    {
        $game = $this->initGame();
        $this->assertInstanceOf(
            BingoBongoGameApiConnector::class,
            $game->getGameConnector()
        );
    }

    public function test_getUniqueSessionId_Returns_IdWithLabel(): void
    {
        $game = $this->initGame();
        $this->assertStringContainsString('bingobongo_', $game->getUniqueSessionId());

    }

    public function test_init_Returns_DataObjectFromXml(): void
    {

        $httpRequest = $this->getMockBuilder(HttpApiRequest::class)
            ->setConstructorArgs([new XmlApiResponse, 'url', 1])
            ->setMethods(['getRequestBody'])
            ->getMock();
        $httpRequest->method('getRequestBody')
            ->willReturn('<tag>data</tag>');

        $connector = $this->getMockBuilder(BingoBongoGameApiConnector::class)
            ->disableOriginalConstructor()
            ->setMethods(['getRequest'])
            ->getMock();
        $connector->method('getRequest')
            ->willReturn($httpRequest);

        $game = $this->getMockBuilder(BingoBongoGame::class)
            ->setConstructorArgs(['key', 'platform'])
            ->setMethods(['getGameConnector'])
            ->getMock();
        $game->method('getGameConnector')
            ->willReturn($connector);

        $init = $game->init();

        $this->assertIsObject($init);
        $this->assertEquals($init[0], 'data');
    }

    /**
     * You get the idea...
     */
}
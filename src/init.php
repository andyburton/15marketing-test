<?php

require_once('vendor/autoload.php');

define('RUN_GAME', 1);

// Set our user

$userId = 'mr_highroller@gmail.com';

// Initialise games

$bingoBongoGame = new BingoBongoGame('key', 'platform');
$bingoBongoGame->init(['init' => 'params']);

$bingoBongoV2Game = new BingoBongoV2Game('key', 'platform');
$bingoBongoGame->init(['different' => 'init params']);

$highStakesPokerGame = new HighStakesPokerGame('access_key');
$highStakesPokerGame->init(['different' => 'init params']);

// Get balance for user in the BingoBongo Game

$bingoBongoGame->balance($userId);

// Make a bet in the BingoBongo Game using V2

$bingoBongoV2Game->bet($userId);

// Make a bet for user in the HighStakesPoker Game

$highStakesPokerGame->bet($userId);

// Log user out of both games

$bingoBongoGame->logout($userId);
$highStakesPokerGame->logout($userId);
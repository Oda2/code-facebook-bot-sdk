<?php

namespace CodeBot;

use CodeBot\Build\Solid;
use PHPUnit\Framework\TestCase;

class BotTest extends TestCase {

  private $pageAccessToken = 'EAABl2zGB88YBAMZBylSp9fVLJ2LC74FymdZCa6i2jIwPnngd1iHMCdQUkZAG6ilwnC0grcYZCMwHyB2YX8Mwa6lZCxq29ChtN1SX7lVS69YD13EKAJoJnmDmtS4ABJV58hFguSoAjhhE0oAaZA61190SKVBkbBuzISOyItSbvNpAZDZD';
  
  public function testAddMenu() {
    
    $bot = Solid::factory();
    Solid::pageAccessToken($this->pageAccessToken);

    $call_to_actions = [
      [
        'id' => 1,
        'type' => 'nested',
        'title' => 'O que eu posso fazer?',
        'parent_id' => 0,
        'value' => null
      ],
      [
        'id' => 2,
        'type' => 'web_url',
        'title' => 'Visite o Google',
        'parent_id' => 0,
        'value' => 'https://www.google.com.br'
      ],
      [
        'id' => 3,
        'type' => 'web_url',
        'title' => 'GitHUb?',
        'parent_id' => 1,
        'value' => 'https://www.github.com'
      ],
      [
        'id' => 4,
        'type' => 'postback',
        'title' => 'Ver as opções?',
        'parent_id' => 1,
        'value' => 'iniciar'
      ],
    ];

    $bot->addMenu('default', false, $call_to_actions);
    $this->AssertTrue(true);
  }  
  
  public function removeMenu() {
    $bot = Solid::factory();
    Solid::pageAccessToken($this->pageAccessToken);

    $bot->removeMenu();
    $this->AssertTrue(true);
  }

  public function testAddGetStartedButton() {
    
    $bot = Solid::factory();
    Solid::pageAccessToken($this->pageAccessToken);

    $bot->addGetStartedButton('iniciar');
    $this->AssertTrue(true);
  }

  public function testRemoveGetStartedButton() {
    $bot = Solid::factory();
    Solid::pageAccessToken($this->pageAccessToken);

    $bot->removeGetStartedButton();
    $this->AssertTrue(true);
  }
}
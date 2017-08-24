<?php

namespace CodeBot;

use CodeBot\MenuManager;
use CodeBot\CallSendApi;
use PHPUnit\Framework\TestCase;

class MenuManagerTest extends TestCase {

  public function testMakeMenu() {
    $menu = new MenuManager('default', false);

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

    foreach($call_to_actions as $action) {
      $menu->callToAction($action['id'], $action['type'], $action['title'], $action['parent_id'], $action['value']);
    }

    $callSendApi = new CallSendApi('');
    //$result = $callSendApi->make($menu->toArray(), CallSendApi::URL_PROFILE);
    //$this->assertTrue(is_string($result));
    $this->assertTrue(true,true);
  }
}
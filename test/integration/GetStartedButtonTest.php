<?php

namespace CodeBot;

use CodeBot\GetStartedButton;
use CodeBot\CallSendApi;
use PHPUnit\Framework\TestCase;

class GetStartedButtonTest extends TestCase {

  public function testAddGetStartedButton() {
    $data = (new GetStartedButton())->add('iniciar');

    $callSendApi = new CallSendApi('');

    $result = $callSendApi->make($data, CallSendApi::URL_PROFILE);

    $this->assertTrue(is_string($result));
  }
}
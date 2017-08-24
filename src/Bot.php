<?php

namespace CodeBot;

class Bot {

  private $senderId;
  private $pageAccessToken;

  public function setSender(string $senderId) {
    $this->senderId = $senderId;
    return $this;
  }

  public function pageAccessToken(string $pageAccessToken) {
    $this->pageAccessToken = $pageAccessToken;
    return $this;
  }

  private function load($class, $namespace) {
    $class = ucfirst($class);
    $class = $namespace . '\\'. $class;

    return new $class($this->senderId);
  }

  private function callSendApi(array $message, string $url = null, $method = 'POST') :string {
    $callSendApi = new CallSendApi($this->pageAccessToken);
    return $$callSendApi->make($message, $url, $method);
  }
}
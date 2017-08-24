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

  public function message(string $type, string $message) {
    $type = $this->load($type, 'CodeBot\Message');

    $message = $type->message($message);
    return $this->callSendApi($message);
  }

  public function template(string $type, string $message, array $elements, array $config) {
    $type = $this->load($type .'Template', 'CodeBot\TemplatesMessage');
    
    foreach($config as $method => $params) {
      call_user_func_array([$type, $methods], $params);
    }

    foreach($elements as $element) {
      $type->add($element)      ;
    }

    $message = $type->message($message);
    
    return $this->callSendApi($message);
  }

  private function load($class, $namespace) {
    $class = ucfirst($class);
    $class = $namespace . '\\'. $class;

    return new $class($this->senderId);
  }

  private function callSendApi(array $message, string $url = null, $method = 'POST') :string {
    $callSendApi = new CallSendApi($this->pageAccessToken);
    return $callSendApi->make($message, $url, $method);
  }
}
<?php

namespace CodeBot;

class MenuManager {
  
  private $locale;
  private $composer_input_disabled;
  private $call_to_actions = [];

  public function __construct(string $locale, bool $composer_input_disabled) {
    $this->locale = $locale;
    $this->composer_input_disabled = $composer_input_disabled;
  }

  public function callToAction($id, $type, $title, $parent_id, $value = null) {
    $this->call_to_actions[] = [
      'id' => $id,
      'type' => $type,
      'title' => $title,
      'parent_id' => $parent_id,
      'value' => $value
    ];
  }

  public function toArray() {
    $call_to_actions = $this->mountCallToAction(0);
    
    $persistent_menu = [
      'locale' => $this->locale,
      'composer_input_disabled' => $this->composer_input_disabled,
      'call_to_actions' => $call_to_actions
    ];

    return [
      'persistent_menu' => [ $persistent_menu ]
    ];
  }

  private function mountCallToAction(int $parent_id = 0): array {
    $result = [];

    foreach($this->call_to_actions as $action) {
      if ($action['parent_id'] === $parent_id) {
  
        $result[] = $this->mountAction($action);
      }
  
      return $result; 
    }
  }

  private function mountAction($action) {
    $data = [
      'type' => $action['type'],
      'title' => $action['title'],
    ];

    if ($action['type'] === 'postback') {
      $data['payload'] = $action['value'];
    }

    if ($action['type'] === 'web_url') {
      $data['url'] = $action['value'];
    }

    if ($action['type'] === 'nested') {
      $data['call_to_actions'] = $this->mountCallToAction($action['id']);
    }

    return $data;
  }
}
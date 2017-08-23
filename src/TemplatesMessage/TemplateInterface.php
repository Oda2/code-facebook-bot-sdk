<?php

namespace CodeBot\TemplatesMessage;

use CodeBot\Message\Message;
use CodeBot\Elements\ElementInterface;

interface TemplateInterface extends Message {
  public function add(ElementInterface $element);
}
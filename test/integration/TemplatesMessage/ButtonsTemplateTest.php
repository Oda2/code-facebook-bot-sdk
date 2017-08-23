<?php

namespace CodeBot\TemplatesMessage;

use CodeBot\Message\Text;
use CodeBot\Elements\Button;
use PHPUnit\Framework\TestCase;

class ButtonsTemplateTest extends TestCase {

  public function testRetornoComBotao() {
    $buttonsTemplates = new ButtonsTemplate(1234);
    $buttonsTemplates->add(new Button('postback', 'Que tal uma resposta?', 'resposta'));

    $actual = $buttonsTemplates->message('Olha um exemplo');

    $expected = [
      'recipient' => [
        'id' => 1234
      ],
      'message' => [
        'attachment' => [
          'type' => 'template',
          'payload' => [
            'template_type' => 'button',
            'text' => 'Olha um exemplo',
            'buttons' => [
              [
                'type' => 'postback',
                'title' => 'Que tal uma resposta?',
                'payload' => 'resposta',
                ]
              ]
            ]
          ]
        ]
      ];

      //fwrite(STDERR, print_r($actual, TRUE));
      //fwrite(STDERR, print_r($expected, TRUE));

    $this->assertEquals($expected, $actual);
  }
}
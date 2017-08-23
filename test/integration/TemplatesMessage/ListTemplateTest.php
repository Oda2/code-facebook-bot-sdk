<?php

namespace CodeBot\TemplatesMessage;

use CodeBot\Message\Message;
use CodeBot\Elements\ElementInterface;
use CodeBot\TemplatesMessage\ListTemplate;

use CodeBot\Elements\Button;
use CodeBot\Elements\Product;

use PHPUnit\Framework\TestCase;

class ListTemplateTest extends TestCase {

  public function testLitaComDoisProdutos() {
    $button = new Button('web_url', null, 'https://www.angular.io');
    $product1 = new Product('Produto 1', 'http://cdn.matera.com/br/wp-content/uploads/2017/02/angular2.png', 'Curso de Angular', $button);

    $button = new Button('web_url', null, 'https://nodejs.org/en/');
    $product2 = new Product('Produto 2', 'https://nodejs.org/static/images/logo.svg', 'Curso de NodeJS', $button);
    
    $template = new ListTemplate(1234);      
    $template->add($product1);
    $template->add($product2);

    $actual = $template->message('qwe');

    $expected = [
      'recipient' => [
        'id' => 1234
      ],
      'message' => [
        'attachment' => [
          'type' => 'template',
          'payload' => [
            'template_type' => 'list',
            'buttons' => [
              [
                'title' => 'Produto 1',                
                'image_url' => 'http://cdn.matera.com/br/wp-content/uploads/2017/02/angular2.png',
                'subtitle' => 'Curso de Angular',
                'default_action' => [
                  'type' => 'web_url',
                  'url' => 'https://www.angular.io',
                ]
              ],
              [
                'title' => 'Produto 2',                
                'image_url' => 'https://nodejs.org/static/images/logo.svg',
                'subtitle' => 'Curso de NodeJS',
                'default_action' => [
                  'type' => 'web_url',
                  'url' => 'https://nodejs.org/en/',
                ]
              ]]
            ]
          ]
        ]
    ];

    //fwrite(STDERR, print_r($actual, TRUE));
    //fwrite(STDERR, print_r($expected, TRUE));

    $this->assertEquals($expected, $actual);
  }
}
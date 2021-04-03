<?php

namespace App\Forms;

use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\TextArea;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;

class PostsForm extends Form {

    public function initialize() {
        $this->setEntity($this);

        $title = new Text('title');
        $title->addValidator(new PresenceOf([
            'message' => 'O título é obrigatório.',
        ]));

        $max = 255;
        $title->addValidator(new StringLength([
            'max' => $max,
            'messageMaximum' => "O título deve possuir $max caracteres no máximo.",
        ]));
        $title->setAttribute('class', 'form-control');

        $body = new TextArea('body');
        $body->setAttribute('class', 'form-control');

        $this->add($title);
        $this->add($body);
    }
}
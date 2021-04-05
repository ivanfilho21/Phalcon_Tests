<?php

namespace App\Forms;

use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Element\TextArea,
    Phalcon\Forms\Element\Select,
    Phalcon\Forms\Element\Check,
    Phalcon\Forms\Element\Date;

use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;

class PostsForm extends Form {

    public function initialize($categoriesList = []) {
        $this->setEntity($this);

        // title
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

        // body
        $body = new TextArea('body');
        $body->setAttribute('class', 'form-control');

        // categories
        /* $categories = new Select(
            'categories',
            \App\Models\Categories::find(), [
                'using' => ['id', 'name']
            ]
        ); */
        // $this->add($categories);

        // published
        $published = new Check('published', ['value' => '1']);
        $published->setLabel('Published');
        
        // publishing date
        $publishingDate = new Date('publishing_date');
        $publishingDate->setAttribute('value', date('Y-m-d'));
        $publishingDate->setAttribute('class', 'form-control');
        
        $this->add($title);
        $this->add($body);
        $this->add($published);
        $this->add($publishingDate);
    }
}
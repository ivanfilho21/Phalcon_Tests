<?php

namespace App\Forms;

use Phalcon\Forms\Form,
    Phalcon\Forms\Element\Text;

use Phalcon\Validation\Validator\PresenceOf,
    Phalcon\Validation\Validator\StringLength;

class CategoryForm extends Form {

    public function initialize() {
        $this->setEntity($this);

        // name
        $name = new Text('name');
        $name->addValidator(new PresenceOf([
            'message' => 'O nome é obrigatório.',
        ]));
        
        $max = 100;
        $name->addValidator(new StringLength([
            'max' => $max,
            'messageMaximum' => "O nome deve possuir $max caracteres no máximo.",
        ]));
        $name->setAttribute('class', 'form-control');

        $this->add($name);
    }

}
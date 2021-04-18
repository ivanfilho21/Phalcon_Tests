<?php

class Likes extends Phalcon\Mvc\Model {
    private $id, $qty;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getQuantity() {
        return $this->qty;
    }

    public function setQuantity($qty) {
        $this->qty = $qty;
    }
}
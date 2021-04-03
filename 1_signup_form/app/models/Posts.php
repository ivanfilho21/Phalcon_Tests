<?php

use Phalcon\Mvc\Model;

class Posts extends Model {
    public $id, $title, $body, $created_at, $updated_at;
}
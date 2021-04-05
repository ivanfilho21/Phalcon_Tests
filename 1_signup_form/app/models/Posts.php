<?php

use Phalcon\Mvc\Model;

class Posts extends Model {
    public $id, $title, $body, $published, $publishing_date, $created_at, $updated_at;
}
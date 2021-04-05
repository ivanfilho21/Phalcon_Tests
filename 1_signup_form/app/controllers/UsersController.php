<?php

class UsersController extends Phalcon\Mvc\Controller {

    public function indexAction() {
        $this->view->users = Users::find();
    }

}
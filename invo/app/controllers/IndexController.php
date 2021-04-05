<?php

class IndexController extends Phalcon\Mvc\Controller {

    function indexAction() {
        $this->view->disable();
        echo $this->view->getRender('home', 'index');
    }

    function notFoundAction() {
        $this->view->disable();
        echo $this->view->getRender('layouts', '404');
    }

}
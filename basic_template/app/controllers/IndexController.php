<?php

class IndexController extends Phalcon\Mvc\Controller {

    function indexAction() {
        $this->view->disable();
        $this->view->likes = Likes::count();

        echo $this->view->getRender('home', 'index');
    }

    function notFoundAction() {
        $this->view->disable();
        echo $this->view->getRender('layouts', '404');
    }

    function likeAction() {
        $like = new Likes();
        $like->setQuantity(1);
        $like->create();

        $this->response->redirect('');
    }

}
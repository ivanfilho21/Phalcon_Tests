<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller {
    
    public function indexAction() {
        $this->view->users = Users::find()->count();
        $this->view->posts = Posts::find()->count();
        $this->view->categories = Categories::find()->count();
    }
}
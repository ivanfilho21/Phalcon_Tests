<?php

use Phalcon\Mvc\Controller;

class IndexController extends Controller {
    
    public function indexAction() {
        // sends the variable 'users' to the view
        $this->view->users = Users::find();
    }
}
<?php

class IndexController extends ControllerBase {

    function initialize() {
        parent::initialize();
        $this->tag->setTitle('Welcome');
    }

    function indexAction() {
        /* $this->flash->notice(
            'This is a sample application of the Phalcon Framework.
            Please don\'t provide us any personal information. Thanks.'
        ); */
    }

    function notFoundAction() {
        $this->view->disable();
        echo $this->view->getRender('layouts', '404');
    }

}
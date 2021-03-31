<?php

use Phalcon\Mvc\Controller;

class SignupController extends Controller {
    
    public function indexAction() {
        //
    }

    public function registerAction() {
        $user = new Users();

        $res = $user->save(
            $this->request->getPost(),
            ['name', 'email']
        );

        if (!$res) {
            $messages = $user->getMessages();
    
            foreach ($messages as $message) {
                echo $message->getMessage(), '<br/>';
            }
        }
    }
}
<?php

use Phalcon\Mvc\Controller;

class SignupController extends Controller {
    
    public function indexAction() {
        if ($this->request->isPost()) {
            $user = new Users();

            $res = $user->create(
                $this->request->getPost(),
                ['name', 'email']
            );

            if (!$res) {
                $this->view->errors = $this->getMessages($user);
                return;
            }
            
            $this->response->redirect('index');
        }
    }
    
    public function editAction($id = 0) {
        if (empty($id)) {
            return $this->response->redirect($_SERVER['HTTP_REFERER']);
        }

        $user = Users::findFirst($id);

        if ($this->request->isPost()) {
            $res = $user->update(
                $this->request->getPost(),
                ['name', 'email']
            );

            if (!$res) {
                $this->view->errors = $this->getMessages($user);
            } else {
                $this->response->redirect('index');
            }
        }

        $this->view->user = $user;
    }

    public function deleteAction($id = 0) {
        $user = Users::findFirst($id);

        if ($user) {
            $user->delete();
        }

        return $this->response->redirect('index');
    }

    private function getMessages($user) {
        $errors = [];
        $messages = $user->getMessages();

        foreach ($messages as $message) {
            $errors[$message->getField()] = ucfirst($message->getMessage()) .'.';
        }

        return $errors;
    }
}
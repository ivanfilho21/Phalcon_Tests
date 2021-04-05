<?php

use Phalcon\Mvc\Controller;

class CategoriesController extends Controller {

    public function indexAction() {
        $key = 'success_msg';
        if (isset($_SESSION[$key])) {
            $this->view->msg = $_SESSION[$key];
            unset($_SESSION[$key]);
        }

        $this->view->categories = Categories::find();
    }

    public function createAction() {
        $form = new App\Forms\CategoryForm();
        $category = new Categories();

        if ($this->request->isPost()) {
            $res = $this->validation($form);

            if (is_array($res)) {
                $this->view->errors = $res;
            } else {
                $category->name = $form->name;
                $category->create();

                // $this->flash->notice('A: ' .$form->name);

                $_SESSION['success_msg'] = "The category \"$category->name\" was created.";
                return $this->response->redirect('categories');
            }
        }

        $this->view->form = $form;
    }

    public function editAction($id = 0) {
        //
    }

    public function deleteAction($id = 0) {
        $c = Categories::findFirst($id);
        $name = $c->name;

        if ($c) {
            $c->delete();
        }

        $this->flash->success("The category \"$name\" was deleted.");
        $this->response->redirect('categories');
    }

    private function validation($form) {
        $res = $form->isValid($this->request->getPost());
        $e = [];

        if (!$res) {
            $msg = $form->getMessages();
            
            foreach ($msg as $m) {
                $key = $m->getField();
                $e[$key] = $m->getMessage();
            }

            return $e;
        }

        return true;
    }

}
<?php

use \Phalcon\Mvc\Controller;

class PostsController extends Controller {

    private $datetimeFormat = 'Y-m-d H:i:s';

    public function indexAction() {
        $this->view->posts = Posts::find();
        $this->view->size = $this->view->posts->count();

        $types = ['success', 'danger'];
        foreach ($types as $type) {
            $key = "{$type}_msg";

            if (isset($_SESSION[$key])) {
                $this->view->msg = $_SESSION[$key];
                unset($_SESSION[$key]);
            }
        }
    }

    public function createAction() {
        $form = new \App\Forms\PostsForm();
        $post = new Posts();

        if ($this->request->isPost()) {
            $res = $this->validation($form);
            
            if (is_array($res)) {
                $this->view->errors = $res;
            } else {
                $this->savePost($post);
                $_SESSION['success_msg'] = "The post \"$post->title\" was created.";
                return $this->response->redirect('posts');
            }
        }

        $cats = Categories::find();
        $list = [];
        foreach ($cats as $c) {
            $list[] = $c->id;
        }
        
        $this->view->form = $form;
        $this->view->categories = $list;

        $this->view->p = $this->request->getPost();
    }

    public function editAction($id = 0) {
        $form = new \App\Forms\PostsForm();
        $post = Posts::findFirst($id);

        if (!$post) {
            return $this->response->redirect('posts');
        }
        
        if ($this->request->isPost()) {
            $res = $this->validation($form);
            
            if (is_array($res)) {
                $this->view->errors = $res;
            } else {
                $this->savePost($post, false);
                $_SESSION['success_msg'] = "The post \"$post->title\" was updated.";
                return $this->response->redirect('posts');
            }

        }
        
        $this->view->form = $form;
        $this->view->post = $post;
    }

    public function deleteAction($id = 0) {
        $post = Posts::findFirst($id);

        if ($post) {
            $post->delete();
        }

        $_SESSION['danger_msg'] = "The post \"$post->title\" was deleted.";
        return $this->response->redirect('posts');
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

    private function savePost(Posts $post, $recordCreation = true) {
        $now = date($this->datetimeFormat);

        $post->title = $this->request->getPost('title');
        $post->body = $this->request->getPost('body');

        $post->published = $this->request->getPost('published') ?? 0;

        if (!empty($post->published)) {
            $post->publishing_date = $this->request->getPost('publishing_date');
        }

        if ($recordCreation) {
            $post->created_at = $now;
        }

        $post->updated_at = $now;

        $post->create();
        $postId = $post->getWriteConnection()->lastInsertId();
        

        $cats = $this->request->getPost('category');

        foreach ($cats as $catId) {
            $postCategory = new PostsCategories();
            $postCategory->id_post = $postId;
            $postCategory->id_category = $catId;
            $postCategory->create();
        }
    }
}
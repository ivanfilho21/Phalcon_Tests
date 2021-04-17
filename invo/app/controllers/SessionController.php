<?php

class SessionController extends ControllerBase {

    function indexAction() {
        //
    }

    function startAction() {
        if ($this->request->isPost()) {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user = Users::findFirst([
                "(email = :email: OR username = :email:) AND password = :password: AND active = 'Y'",
                'bind' => [
                    'email' => $email,
                    'password' => $this->_encrypt($password),
                ]
            ]);

            if (!$user) {
                $this->flash->error('Suas credenciais não são válidas.');
            }
        }
    }

    private function _registerSession($user) {
        $this->session->set('auth', [
            'id' => $user->id,
            'name' => $user->name,
        ]);
    }

    private function _encrypt(string $str) {
        if (empty($str)) {
            return $str;
        }

        $opt = ['cost' => 11];
        return password_hash($str, PASSWORD_BCRYPT, $options);
    }

}
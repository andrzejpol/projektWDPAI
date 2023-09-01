<?php

require_once 'AppController.php';

class AuthController extends AppController
{
    private $messages = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function signup()
    {
        $this->render('register');
    }

    public function signin()
    {
        $this->render('login');
    }

    public function register()
    {
        if (!$this->isPost()) {
            return $this->render('login');
        }

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirm'];

        if (!strlen($username)) {
            return $this->render('register', ['errors' => ['Username cannot be empty']]);
        }

        if (!strlen($password)) {
            return $this->render('register', ['errors' => ['Password must be at least 6 characters long.']]);
        }

        if ($password !== $confirmedPassword) {
            return $this->render('register', ['errors' => ['Please provide proper password.']]);
        }
    }
}

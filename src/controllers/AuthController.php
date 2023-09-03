<?php

require_once 'AppController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class AuthController extends AppController
{
    private $messages = [];
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
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
            return $this->render('register');
        }

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmedPassword = $_POST['confirmPassword'];

        if (!strlen($username)) {
            return $this->render('register', ['errors' => ['Username cannot be empty']]);
        }

        if (!strlen($password)) {
            return $this->render('register', ['errors' => ['Password must be at least 6 characters long.']]);
        }

        if ($password !== $confirmedPassword) {
            return $this->render('register', ['errors' => ['Please provide proper password.']]);
        }

        $user = new User($email, $password, $username);

        $this->userRepository->addUser($user);

        return $this->render('login', ['messages' => ['You have been successfully registered.']]);
    }
}

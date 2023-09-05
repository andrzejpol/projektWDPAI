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

    public function logout()
    {
        $this->render('logout');
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

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $user = new User($email, $hashedPassword, $username);

        $this->userRepository->addUser($user);

        return $this->render('login', ['messages' => ['You have been successfully registered.']]);
    }

    public function login()
    {
        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->render('login', ['errors' => ['Invalid email address.']]);
        }

        $user =  $this->userRepository->getUserByEmail($email);

        if (!$user) {
            return $this->render('login', ['errors' => ['User does not exist.']]);
        }

        if (!password_verify($password, $user->getPassword())) {
            return $this->render('login', ['errors' => ['Wrong password.']]);
        }



        session_start();
        $_SESSION['userId'] = $user->getId();
        $_SESSION['username'] = $user->getUsername();
        $_SESSION['user_role'] = $user->getUserRole();

        $url = "http://$_SERVER[HTTP_HOST]";

        if ($user->getUserRole() === "admin") {
            header("Location: {$url}/");
        } else {
            header("Location: {$url}/cars");
        }
    }
}

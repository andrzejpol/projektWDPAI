<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController {
    public function login() {
        $user = new User('random@edu.pl', 'passwd', 'John', 'Snow');

        $email = $_POST["email"];
        $password = $_POST["password"];

         if ($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User does not exist!']]);
         }

         if ($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
         }

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/projects");
    }
}
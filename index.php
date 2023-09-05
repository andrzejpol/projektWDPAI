<?php

require 'Routing.php';

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('', 'DefaultController');
Routing::get('cars', 'DefaultController');
Routing::get('main', 'DefaultController');
Routing::post('login', 'AuthController');
Routing::get('logout', 'AuthController');
Routing::get('signup', 'AuthController');
Routing::get('signin', 'AuthController');
Routing::post('register', 'AuthController');
Routing::get('faq', 'DefaultController');
Routing::get('contact', 'DefaultController');
Routing::get('usersEdit', 'UsersController');
Routing::post('deleteUser', 'UsersController');
Routing::post('updateUser', 'UsersController');
Routing::get('carsEdit', 'DefaultController');
Routing::run($path);

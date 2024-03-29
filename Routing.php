<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/AuthController.php';
require_once 'src/controllers/UsersController.php';
require_once 'src/controllers/CarsController.php';
require_once 'src/controllers/FaqsController.php';
require_once 'src/controllers/RentalController.php';

class Routing
{
    public static $routes;

    public static function get($url, $controller)
    {
        self::$routes[$url] = $controller;
    }

    public static function post($url, $controller)
    {
        self::$routes[$url] = $controller;
    }

    public static function run($url)
    {
        $urlParts = explode("/", $url);
        $action = $urlParts[0];

        if (!array_key_exists($action, self::$routes)) {
            die("Wrong url!");
        }

        $controller = self::$routes[$action];
        $object = new $controller;
        $action = $action ?: 'index';

        $id = $urlParts[1] ?? '';

        $object->$action($id);
    }
}

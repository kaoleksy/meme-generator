<?php

require_once 'controllers/LoginController.php';
require_once 'controllers/RegisterController.php';

class Routing
{
    public $routes = [];

    public function __construct()
    {
        $this->routes = [
            'index' => [
                'controller' => 'LoginController',
                'action' => 'index'
            ],
            'login' => [
                'controller' => 'LoginController',
                'action' => 'login'
            ],
            'register' => [
                'controller' => 'RegisterController',
                'action' => 'register'
            ]
        ];
    }

    public function run()
    {
        $page = isset($_GET['page'])
        && isset($this->routes[$_GET['page']]) ? $_GET['page'] : 'login';

        if ($this->routes[$page]) {
            $class = $this->routes[$page]['controller'];
            $action = $this->routes[$page]['action'];

            $object = new $class;
            $object->$action();
        }
    }
}
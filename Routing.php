<?php

require_once 'controllers/LoginController.php';
require_once 'controllers/IndexController.php';
require_once 'controllers/RegisterController.php';
require_once 'controllers/UploadController.php';
require_once 'controllers/GenerateController.php';
require_once 'controllers/UserMemesController.php';

class Routing
{
    public $routes = [];

    public function __construct()
    {
        $this->routes = [
            'index' => [
                'controller' => 'IndexController',
                'action' => 'index'
            ],
            'index_memes' => [
                'controller' => 'IndexController',
                'action' => 'memes'
            ],
            'login' => [
                'controller' => 'LoginController',
                'action' => 'login'
            ],
            'register' => [
                'controller' => 'RegisterController',
                'action' => 'register'
            ],
            'logout' => [
                'controller' => 'IndexController',
                'action' => 'logout'
                ],
            'upload' => [
                'controller' => 'UploadController',
                'action' => 'upload'
            ],
            'generate' => [
                'controller' => 'GenerateController',
                'action' => 'generate'
            ],
            'generated' => [
                'controller' => 'GenerateController',
                'action' => 'generate'
            ],
            'latest_meme' => [
                'controller' => 'GenerateController',
                'action' => 'generated'
            ],
            'your_uploaded_memes' => [
                'controller' => 'UserMemesController',
                'action' => 'userUploadedMemes'
            ],
            'your_generated_memes' => [
                'controller' => 'UserMemesController',
                'action' => 'userGeneratedMemes'
            ],
            'your_memes' => [
                'controller' => 'UserMemesController',
                'action' => 'yourMemes'
            ],
            'admin' => [
                'controller' => 'AdminController',
                'action' => 'index'
            ],
            'admin_users' => [
                'controller' => 'AdminController',
                'action' => 'users'
            ],
            'admin_delete_user' => [
                'controller' => 'AdminController',
                'action' => 'userDelete'
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
<?php
require_once 'AppController.php';

require_once __DIR__.'/../model/User.php';
require_once __DIR__.'/../model/UserMapper.php';

class AdminController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $user = new UserMapper();
        $this->render('AdminController','admin', ['user' => $user->getUser($_SESSION['email'])]);
    }

    public function users()
    {
        $user = new UserMapper();

        header('Content-type: application/json');
        http_response_code(200);
        echo $user->getUsers() ? json_encode($user->getUsers()) : '';
    }

    public function userDelete()
    {
        if (!isset($_POST['id'])) {
            http_response_code(404);
            return;
        }

        $user = new UserMapper();
        $user->delete((int)$_POST['id']);

        http_response_code(200);
    }
}
<?php

require_once "AppController.php";

require_once __DIR__.'/../model/User.php';
require_once __DIR__.'/../model/UserMapper.php';


class LoginController extends AppController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        $mapper = new UserMapper();

        $user = null;

        if ($this->isPost()) {

            $user = $mapper->getUser($_POST['email']);

            if(!$user) {
                return $this->render("LoginController", 'login', ['message' => ['Email not recognized']]);
            }

            if ($user->getPassword() !== md5($_POST['password'])) {
                return $this->render("LoginController", 'login', ['message' => ['Wrong password']]);
            } else {
                $_SESSION["email"] = $user->getEmail();
                $_SESSION["username"] = $user->getUsername();
                $_SESSION["role"] = $user->getRole();

                $url = "http://$_SERVER[HTTP_HOST]/";
                header("Location: {$url}?page=index");
                exit();
            }
        }

        $this->render("LoginController",'login');
    }

}
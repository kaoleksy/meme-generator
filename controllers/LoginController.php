<?php

require_once "AppController.php";
require_once "AdminController.php";

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
                $_SESSION["ID"] = $user->getId();
                $_SESSION["email"] = $user->getEmail();
                $_SESSION["username"] = $user->getUsername();
                $_SESSION["role_id"] = $user->getRole();

                if($_SESSION['role_id']!=1) {
                    $url = "http://$_SERVER[HTTP_HOST]";
                    header("Location: {$url}?page=index");
                }
                else {
                    $url = "http://$_SERVER[HTTP_HOST]";
                    header("Location: {$url}?page=admin");
                }

                exit();
            }
        }

        $this->render("LoginController",'login');
    }

}
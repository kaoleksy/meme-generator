<?php
require_once "AppController.php";

require_once __DIR__.'/../model/User.php';
require_once __DIR__.'/../model/UserMapper.php';


class RegisterController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function register()
    {
        $mapper = new UserMapper();
        $newUser = null;

        if($this->isPost()){
            $registerUser = $mapper->registerUser(
                                        $_POST['username'],
                                        $_POST['name'],
                                        $_POST['surname'],
                                        $_POST['email'],
                                        $_POST['password'],
                                        "ROLE_USER"
                                    );

            if($registerUser) {
                return $this->render("RegisterController", 'register', [
                    'message' => [
                        'You are registered successfully. 
                         <br/>Click here to <a href=\'?page=login\'>login</a>'
                    ]
                ]);
            } else {
                return $this->render("RegisterController", 'register', ['message' => ['Something went wrong, try again']]);
            }
        }
        $this->render("RegisterController",'register', [ 'message' => ['<br/>Click here to <a href=\'?page=login\'>back to login</a>']]);
    }
}
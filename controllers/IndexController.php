<?php

require_once 'AppController.php';

class IndexController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $text = 'It\'s index page!';
        $this->render("IndexController",'index', ['text' => $text]);
    }
    public function logout()
    {
        session_unset();
        session_destroy();
        $this->render("LoginController", 'login', ['message' => ['You have been successfully logged out!']]);
    }
}
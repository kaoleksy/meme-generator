<?php

require_once 'AppController.php';
require_once __DIR__.'/../model/MemeMapper.php';

class IndexController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->render("IndexController",'index');
    }
    public function logout()
    {
        session_unset();
        session_destroy();
        $this->render("LoginController", 'login', ['message' => ['You have been successfully logged out!']]);
    }

    public function memes()
    {
        $memeMapper = new MemeMapper();
        header('Content-type: application/json');
        http_response_code(200);
        echo $memeMapper->getMemes() ? json_encode($memeMapper->getMemes()) : '';
    }
}
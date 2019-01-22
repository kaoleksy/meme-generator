<?php


require_once "AppController.php";
require_once __DIR__.'/../model/MemeMapper.php';

class UserMemesController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function userUploadedMemes()
    {
        $memeMapper = new MemeMapper();
        $userMapper = new UserMapper();
        $userId = null;
        if( isset( $_SESSION['email'])) {
            $userId = $userMapper->getUser($_SESSION['email'])->getId();
        }
        header('Content-type: application/json');
        http_response_code(200);
        echo $memeMapper->getUserMemes($userId) ? json_encode($memeMapper->getUserMemes($userId)) : '';
    }

    public function userGeneratedMemes()
    {
        $memeMapper = new MemeMapper();
        $userMapper = new UserMapper();
        $userId = null;
        if( isset( $_SESSION['email'])) {
            $userId = $userMapper->getUser($_SESSION['email'])->getId();
        }
        header('Content-type: application/json');
        http_response_code(200);
        echo $memeMapper->getUserGeneratedMemes($userId) ? json_encode($memeMapper->getUserGeneratedMemes($userId)) : '';
    }

    public function yourMemes()
    {
        $this->render("UserMemesController",'memes');
    }

}
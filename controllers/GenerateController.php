<?php

require_once "AppController.php";
require_once __DIR__.'/../model/MemeGenerator.php';
require_once __DIR__.'/../model/MemeGeneratorMapper.php';
require_once __DIR__.'/../model/UserMapper.php';


class GenerateController extends AppController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function generate()
    {
        $userMapper = new UserMapper();
        $memeGeneratorMapper = new MemeGeneratorMapper();
        $username = $_SESSION['username'].'/';
        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name'])) {
            $uploadDirectory = dirname(__DIR__).self::GENERATE_DIRECTORY.$username.$_FILES['file']['name'];
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                $uploadDirectory
            );
            $userId = null;
            if( isset( $_SESSION['email'])) {
                $userId = $userMapper->getUser($_SESSION['email'])->getId();
            }
            list($width, $height) = getimagesize($uploadDirectory);
            $generatedDirectory = dirname(__DIR__).GENERATED_DIRECTORY.$username.$_FILES['file']['name'];
            $memeGenerator = new MemeGenerator($uploadDirectory, $width, $height);
            $memeGenerator->generateMeme($_POST['toptext'], $_POST['bottomtext']);
            $memeGeneratorMapper->addGeneratedMeme($_POST['title'], $width, $height, $generatedDirectory,$userId);
            $this->render("GenerateController",'generated');
        } else {
            $this->render("GenerateController",'generate');
        }
    }

    public function generated()
    {
        $memeMapper = new MemeGeneratorMapper();
        $userMapper = new UserMapper();
        $userId = null;
        if( isset( $_SESSION['email'])) {
            $userId = $userMapper->getUser($_SESSION['email'])->getId();
        }
        header('Content-type: application/json');
        http_response_code(200);
        echo $memeMapper->getLatestUserMeme($userId) ? json_encode($memeMapper->getLatestUserMeme($userId)) : '';
    }


}
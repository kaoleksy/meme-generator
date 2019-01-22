<?php


require_once "AppController.php";
require_once __DIR__.'/../model/MemeMapper.php';

class MemeDetailsController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }


    public function addComment()
    {
        if (!isset($_POST['id']) && !isset($_POST['comment'])) {
            http_response_code(404);
            return;
        }
        $meme = new MemeMapper();
        $meme->addComment((int)$_POST['id'], $_POST['comment']);
        http_response_code(200);
    }

    public function showComments()
    {
        if (!isset($_POST['id'])) {
            http_response_code(404);
            return;
        }
        $meme = new MemeMapper();
        http_response_code(200);
        echo $meme->getAllMemeComments((int)$_POST['id'])? json_encode($meme->getAllMemeComments((int)$_POST['id'])) : '';

    }
}
<?php
require_once __DIR__.'/../model/MemeMapper.php';

class UploadController extends AppController
{
    const MAX_FILE_SIZE = 150000;
    const SUPPORTED_TYPES = ['image/jpeg', 'image/png', 'image/gif'];

    private $message = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function upload()
    {
        $memeMapper = new MemeMapper();
        $userMapper = new UserMapper();

        if ($this->isPost() && $this->validate($_FILES['file'])) {
            $userLogin=$_SESSION['username'].'/';
            $userId = null;
            if( isset( $_SESSION['email'])) {
                $userId = $userMapper->getUser($_SESSION['email'])->getId();
            }
            $uploadDirectory = dirname(__DIR__).self::GENERATE_DIRECTORY.$userLogin.$_FILES['file']['name'];


            if(move_uploaded_file(
                $_FILES['file']['tmp_name'],
                $uploadDirectory
            )) {
                $memeMapper->addMeme($uploadDirectory, $_POST['title'], $userId);
                $this->message[] = 'File uploaded.';
            }
        }
        $this->render('UploadController', 'upload', [ 'message' => $this->message]);
    }

    private function validate(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->message[] = 'File is too large for destination file system.';
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->message[] = 'File type is not supported.';
            return false;
        }
        return true;
    }
}
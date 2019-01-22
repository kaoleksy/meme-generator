<?php
/**
 * Created by PhpStorm.
 * User: kasia
 * Date: 19.01.19
 * Time: 12:58
 */

require_once __DIR__.'/../Database.php';

class MemeMapper
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function addMeme($path, $title, $user_id)
    {
        try {
            $stmt = $this->database->connect()->prepare("INSERT INTO `meme` (path, title, user_id) 
                                                                   VALUES('$path', '$title', '$user_id')");
            $stmt->bindParam(':path', $path, PDO::PARAM_STR);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
            $stmt->execute();
            return true;
        }
        catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getMemes() {
        try {
            $stmt = $this->database->connect()->prepare('SELECT meme.id, meme.path, meme.title, users.username FROM meme LEFT JOIN users ON users.ID = meme.user_id ORDER BY meme.id DESC;');
            $stmt->execute();
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $user;
        }
        catch(PDOException $e) {
            die();
        }
    }

    public function getUserMemes($user_id) {
        try {
            $stmt = $this->database->connect()->prepare('SELECT path, user_id FROM meme WHERE user_id = :user_id');
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $user;
        }
        catch(PDOException $e) {
            die();
        }
    }

    public function getUserGeneratedMemes($user_id) {
        try {
            $stmt = $this->database->connect()->prepare('SELECT path, user_id FROM generated_meme WHERE user_id = :user_id');
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $user;
        }
        catch(PDOException $e) {
            die();
        }
    }

    public function addComment($meme_id, $comment)
    {
        try {
            $userMapper = new UserMapper();
            $userId = null;
            if( isset( $_SESSION['email'])) {
                $userId = $userMapper->getUser($_SESSION['email'])->getId();
            }
            $stmt = $this->database->connect()->prepare("INSERT INTO `comment` (comment, meme_id, user_id) 
                                                                   VALUES('$comment', '$meme_id', '$userId')");
            $stmt->bindParam(':meme_id', $meme_id, PDO::PARAM_INT);
            $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            //echo $userId." ".$meme_id." ".$comment;
            return true;
        }
        catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getAllMemeComments($id)
    {
        try {
            $stmt = $this->database->connect()->prepare('SELECT id, comment FROM comment WHERE meme_id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $comments;
        }
        catch(PDOException $e) {
            die();
        }
    }
}
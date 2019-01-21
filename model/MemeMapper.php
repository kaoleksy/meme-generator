<?php
/**
 * Created by PhpStorm.
 * User: kasia
 * Date: 19.01.19
 * Time: 12:58
 */

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
            $stmt = $this->database->connect()->prepare('SELECT meme.id, meme.path, meme.title, users.username FROM meme LEFT JOIN users ON users.ID = meme.user_id;;');
            $stmt->execute();
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $user;
        }
        catch(PDOException $e) {
            die();
        }
    }

}
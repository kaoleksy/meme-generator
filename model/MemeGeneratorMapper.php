<?php
/**
 * Created by PhpStorm.
 * User: kasia
 * Date: 21.01.19
 * Time: 16:17
 */

class MemeGeneratorMapper
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function addGeneratedMeme($title, $width, $height, $path, $user_id)
    {
        try {
            $date = date('Y-m-d H:i:s');
            $stmt = $this->database->connect()->prepare("INSERT INTO `generated_meme` (title, width, height, path, create_date, user_id) 
                                                                   VALUES('$title', '$width','$height', '$path', '$date', '$user_id')");
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':width', $width, PDO::PARAM_STR);
            $stmt->bindParam(':height', $height, PDO::PARAM_STR);
            $stmt->bindParam(':path', $path, PDO::PARAM_STR);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
            $stmt->execute();
            return true;
        }
        catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getLatestUserMeme($user_id)
    {
        try {
            $stmt = $this->database->connect()->prepare('SELECT path, title FROM generated_meme WHERE user_id = :user_id order by create_date desc limit 1;');
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $latest = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $latest;
        }
        catch(PDOException $e) {
            die();
        }
    }

}
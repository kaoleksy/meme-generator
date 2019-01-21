<?php

require_once 'User.php';
require_once __DIR__.'/../Database.php';

class UserMapper
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getUser(string $email):User {
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM users WHERE email = :email;');
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            return new User($user['ID'], $user['username'], $user['name'], $user['surname'], $user['email'], $user['password']);
        }
        catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getUsers()
    {
        try {
            $stmt = $this->database->connect()->prepare('SELECT * FROM users WHERE email != :email;');
            $stmt->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $user;
        }
        catch(PDOException $e) {
            die();
        }
    }

    public function delete(int $id): void
    {
        try {
            $stmt = $this->database->connect()->prepare('DELETE FROM users WHERE id = :id;');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        }
        catch(PDOException $e) {
            die();
        }
    }

    public function registerUser($username, $name, $surname, $email, $password, $role)
    {
        try {
            $stmt = $this->database->connect()->prepare("INSERT INTO `users` (username, name, surname, email, password, role) 
                                                                   VALUES('$username', '$name', '$surname', '$email', '".md5($password)."', '$role' )");
            $stmt->execute();
            $this->createUserDirectory($username);
            $this->createUserGenerateDirectory($username);
            $this->createUserGeneratedDirectory($username);
            return true;
        }
        catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function createUserDirectory($user){
        $folder = dirname(__DIR__).'/public/upload/'.$user;
        $old_umask = umask(0);
        if (!mkdir($folder, 0777, true)) {
            return false;
        }
        umask($old_umask);
        return true;
    }

    public function createUserGenerateDirectory($user){
        $folder = dirname(__DIR__).'/public/generate/'.$user;
        $old_umask = umask(0);
        if (!mkdir($folder, 0777, true)) {
            return false;
        }
        umask($old_umask);
        return true;
    }


    public function createUserGeneratedDirectory($user){
        $folder = dirname(__DIR__).'/public/generatedMemes/'.$user;
        $old_umask = umask(0);
        if (!mkdir($folder, 0777, true)) {
            return false;
        }
        umask($old_umask);
        return true;
    }
}
<?php

class User
{
    private $id;
    private $username;
    private $name;
    private $surname;
    private $email;
    private $password;
    private $role_id;

    public function __construct($id, $username, $name, $surname, $email, $password, $role_id)
    {
        $this->id = $id;
        $this->username = $username;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        $this->role_id = $role_id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username): void
    {
        $this->username = $username;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surname): void
    {
        $this->surname = $surname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = md5($password);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRole(): int
    {
        return $this->role_id;
    }

    public function setRole(string $role_id): void
    {
        $this->role_id = $role_id;
    }
}
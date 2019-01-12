<?php

require_once 'Parameters.php';

class Database
{
    private $serverName;
    private $username;
    private $password;
    private $database;


    public function __construct()
    {
        $this->serverName = SERVERNAME;
        $this->username = USERNAME;
        $this->password = PASSWORD;
        $this->database = DBNAME;
    }

    public function connect()
    {
        try {
            return new PDO("mysql:host=$this->serverName;dbname=$this->database", $this->username, $this->password);
            print_r("polaczenie");
        }
        catch(PDOException $e)
        {
            return 'Connection failed: ' . $e->getMessage();
        }
    }
}
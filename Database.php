<?php

require_once 'config.php';

class Database
{
    private static $instance;
    private $username;
    private $password;
    private $host;
    private $port;
    private $database;

    public function __construct()
    {

        $this->username = USERNAME;
        $this->password = PASSWORD;
        $this->host = HOST;
        $this->port = PORT;
        $this->database = DATABASE;
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function connect()
    {
        try {
            $connect = new PDO(
                "pgsql:host=$this->host;port=$this->port;dbname=$this->database",
                $this->username,
                $this->password,
                ["sslmode"  => "prefer"]
            );

            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connect;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}

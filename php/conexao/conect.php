<?php
class DatabaseConnection
{
    private static $instance = null;
    private $conn;
    private function __construct()
    
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "projeto_final";
        $this->conn = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn->connect_error) {
            die("Falha na conexão: " . $this->conn->connect_error);
        } else {
        }
    }
  
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new DatabaseConnection();
        }
        return self::$instance;
    }
    
    public function getConnection()
    {
        return $this->conn;
    }
}
?>
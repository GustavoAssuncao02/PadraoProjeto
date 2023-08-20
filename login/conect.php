<?php
//Conexão como  banco de dados com o singleton com o databaseconne....
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
           // echo "Conexão bem-sucedida!"; - caso precise verificar a conexão no bd, so tirar as barras
           
           //Aparece uma página branca depois de cadastrar antes de redirecionar para o cadastro.html
           // vou arrumar depois.
        }
    }
  

//usa o padrão de projeto do singleton, creio que seja isso que camada quer

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
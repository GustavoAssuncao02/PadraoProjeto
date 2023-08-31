<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "../conexao/conect.php";
require_once "AdminAuthenticationHandler.php";
require_once 'LogSingleton.php';
require_once "cadastroStrategy.php";
class CadastroPadrao implements CadastroStrategy
{
    public function cadastrar($nome, $senha, $email, $data, $cpf)
    {
        $administrador = 0;

        $dbConnection = DatabaseConnection::getInstance();
        $conn = $dbConnection->getConnection();

        $query = "INSERT INTO projeto_final.trabalhofinal (nome, senha, email, dataNascimento, cpf, administrador) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssi", $nome, $senha, $email, $data, $cpf, $administrador);

        $log = LogSingleton::getInstance();

        if ($stmt->execute()) {
            $log->logEvent("Novo usuário cadastrado: $nome $cpf");
            echo '<script>setTimeout(function(){ window.location.href = "../../html/index.html"; }, 2000);</script>';
            return true;
        } else {
            $log->logEvent("Erro no cadastro: " . $stmt->error);
            echo "Erro no cadastro: " . $stmt->error;
            return false;
        }
    }
}

class CadastroAdm implements CadastroStrategy
{
    public function cadastrar($nome, $senha, $email, $data, $cpf)
    {
        $administrador = 1;

        $dbConnection = DatabaseConnection::getInstance();
        $conn = $dbConnection->getConnection();

        $query = "INSERT INTO projeto_final.trabalhofinal (nome, senha, email, dataNascimento, cpf, administrador) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssi", $nome, $senha, $email, $data, $cpf, $administrador);

        $log = LogSingleton::getInstance();

        if ($stmt->execute()) {
            $log->logEvent("Novo usuário cadastrado: $nome $cpf");
            echo '<script>setTimeout(function(){ window.location.href = "../../html/index.html"; }, 2000);</script>';
            return true;
        } else {
            $log->logEvent("Erro no cadastro: " . $stmt->error);
            echo "Erro no cadastro: " . $stmt->error;
            return false;
        }
    }
    }

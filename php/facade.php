<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "conect.php";
require_once "AdminAuthenticationHandler.php"; // Certifique-se de incluir os arquivos necessários
require_once 'LogSingleton.php';
class Facade
{
    public $adminHandler;
    public $userHandler;

    public function __construct()
    {
        $this->adminHandler = new AdminAuthenticationHandler();
        $this->userHandler = new UserAuthenticationHandler();

        // Configure a cadeia de responsabilidade
        $this->adminHandler->setSuccessor($this->userHandler);
    }

    public function login($email, $senha)
    {
        $tipoAutenticacao = $this->adminHandler->handleAuthentication($email, $senha);
        if ($tipoAutenticacao === "admin") {
            header("Location: admin_page.php?email=" . urlencode($email));
            exit;
        } elseif ($tipoAutenticacao === "user") {
            header("Location: index_perfil.php?email=" . urlencode($email));
            exit;
        } else {
            echo "teste";
            echo $tipoAutenticacao;
            //header("Location: ../html/cadastro.html?erro=1"); 
            exit;
        }
    }
    public static function excluirUsuario($id)
    {
        $dbConnection = DatabaseConnection::getInstance()->getConnection();
        $query = "DELETE FROM projeto_final.trabalhofinal WHERE id = ?";
        $stmt = $dbConnection->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function editarUsuario($nomeAtualizado,$emailAtualizado, $dataNascimentoAtualizado, $senhaAtualizado)
    {

        $dbConnection = DatabaseConnection::getInstance()->getConnection();

        $query = "UPDATE projeto_final.trabalhofinal SET nome = ?, dataNascimento = ?, senha = ? WHERE email = ?";
        $stmt = $dbConnection->prepare($query);
        $stmt->bind_param("ssss", $nomeAtualizado, $dataNascimentoAtualizado, $senhaAtualizado, $emailAtualizado);

        $stmt->execute();


        $logInstance = LogSingleton::getInstance();
        $userId = $_SESSION['user_id']; 
        $logMessage = "Usuário $userId editou o perfil: \nNome alterado para - $nomeAtualizado, \nData de nascimento alterada para - $dataNascimentoAtualizado, \nSenha alterada.";
        $logInstance->logEvent($logMessage);

    
        header("Location: perfil_usuario.php?email=" . urlencode($emailAtualizado));
        exit;
    
    }

    public function cadastrarUsuario($nome, $senha, $email, $data, $cpf)
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
        echo '<script>setTimeout(function(){ window.location.href = "../html/index.html"; }, 2000);</script>';
        return true;
    } else {
        $log->logEvent("Erro no cadastro: " . $stmt->error);
        echo "Erro no cadastro: " . $stmt->error;
        return false;
    }
    }
}


?>
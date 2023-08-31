<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "conect.php";
require_once "AdminAuthenticationHandler.php"; // Certifique-se de incluir os arquivos necessários
require_once 'LogSingleton.php';
require_once "cadastrosStrategy.php";
class Facade
{
    public $cadastroStrategy2;
    public $cadastroStrategy;
    public $adminHandler;
    public $userHandler;

    public function __construct()
    {
        $this->adminHandler = new AdminAuthenticationHandler();
        $this->userHandler = new UserAuthenticationHandler();

        // Configure a cadeia de responsabilidade
        $this->adminHandler->setSuccessor($this->userHandler);
        $this->cadastroStrategy = new CadastroPadrao();
        $this->cadastroStrategy2 = new CadastroAdm();
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
    public function cadastrarUsuario($nome, $senha, $email, $data, $cpf) {
        return $this->cadastroStrategy->cadastrar($nome, $senha, $email, $data, $cpf);
    }
    public function cadastrarAdm($nome, $senha, $email, $data, $cpf) {
        return $this->cadastroStrategy2->cadastrar($nome, $senha, $email, $data, $cpf);
    }

    
}


?>
<?php
require_once "conect.php";
require_once "AdminAuthenticationHandler.php"; // Certifique-se de incluir os arquivos necessários

class AuthenticationFacade {
    public $adminHandler;
    public $userHandler;

    public function __construct() {
        $this->adminHandler = new AdminAuthenticationHandler();
        $this->userHandler = new UserAuthenticationHandler();

        // Configure a cadeia de responsabilidade
        $this->adminHandler->setSuccessor($this->userHandler);
    }

    public function login($email, $senha) {
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
}

// Uso da classe AuthenticationFacade

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $authFacade = new AuthenticationFacade();
    $authFacade->login($email, $senha);
}

?>

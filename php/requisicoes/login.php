<?php
require_once "../padroes/AdminAuthenticationHandler.php";
require_once '../padroes/LogSingleton.php';
require_once "../padroes/cadastrosStrategy.php";
require_once "../conexao/conect.php";


class Login
{
    public $adminHandler;
    public $userHandler;
    public function __construct()
    {
        $this->adminHandler = new AdminAuthenticationHandler();
        $this->userHandler = new UserAuthenticationHandler();
        $this->adminHandler->setSuccessor($this->userHandler);
    }
    public function login( $email, $senha)
    {
        $tipoAutenticacao = $this->adminHandler->handleAuthentication($email, $senha);
        if ($tipoAutenticacao === "admin") {
            header("Location: ../index/admin_page.php?email=" . urlencode($email));
            exit;
        } elseif ($tipoAutenticacao === "user") {
            header("Location: ../index/index_perfil.php?email=" . urlencode($email));
            exit;
        } else {
            //header("Location: ../html/cadastro.html?erro=1"); 
            exit;
        }
    }
}
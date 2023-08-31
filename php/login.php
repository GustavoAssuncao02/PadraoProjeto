<?php
require_once "AdminAuthenticationHandler.php";
require_once 'LogSingleton.php';
require_once "cadastrosStrategy.php";
require_once "conect.php";


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
            header("Location: admin_page.php?email=" . urlencode($email));
            exit;
        } elseif ($tipoAutenticacao === "user") {
            header("Location: index_perfil.php?email=" . urlencode($email));
            exit;
        } else {
            //header("Location: ../html/cadastro.html?erro=1"); 
            exit;
        }
    }
}
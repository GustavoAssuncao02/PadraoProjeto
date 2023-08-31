<?php
require_once "conect.php";
require_once "AdminAuthenticationHandler.php";


// Crie as instâncias das classes de autenticação
$adminHandler = new AdminAuthenticationHandler();
$userHandler = new UserAuthenticationHandler();

// Configure a cadeia de responsabilidade
$adminHandler->setSuccessor($userHandler);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $tipoAutenticacao = $adminHandler->handleAuthentication($email, $senha);
    if ($tipoAutenticacao === "user") {
        header("Location: index_perfil.php?email=" . urlencode($email)); 
        exit;
    } elseif ($tipoAutenticacao === "admin") {
        header("Location: admin_page.php?email=" . urlencode($email)); 
        exit;
    } else {
        echo "teste";
        //header("Location: ../html/cadastro.html?erro=1"); 
        exit;
    }
}
?>
<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $facade = new UserAuthenticationFacade();

    $tipoAutenticacao = $facade->login($email, $senha);

    if ($tipoAutenticacao === "admin") {
        header("Location: ../php/admin_page.php?email=" . urlencode($email));
        exit;
    } elseif ($tipoAutenticacao === "user") {
        header("Location: ../php/index_perfil_user.php?email=" . urlencode($email));
        exit;
    } else {
        header("Location: ../html/cadastro.html?erro=1");
        exit;
    }
}
?>
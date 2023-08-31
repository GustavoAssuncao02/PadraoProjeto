<?php
require_once "../conexao/conect.php";
require_once '../padroes/facade.php';
require_once '../padroes/LogSingleton.php';
require_once 'editarUsuario.php';
require_once "Login.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $authFacade = new Facade();
    $authFacade->login($email, $senha);
}

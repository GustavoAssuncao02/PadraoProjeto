<?php
require_once "conect.php";
require_once 'facade.php';
require_once 'conect.php';
require_once 'LogSingleton.php';
require_once 'editarUsuario.php';
require_once "Login.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $authFacade = new Facade();
    $authFacade->login($email, $senha);
}

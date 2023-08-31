<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'facade.php';
require_once 'conect.php';
require_once 'LogSingleton.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $senha = $_POST["senha"];
    $email = $_POST["email"];
    $data = $_POST["data"];
    $cpf = $_POST["cpf"];
    $administrador = 0;
}
$novoUsuario = new Facade( );
$novoUsuario->cadastrarUsuario($nome, $senha,$email, $data , $cpf);
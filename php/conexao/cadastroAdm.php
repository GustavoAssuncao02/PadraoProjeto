<?php
require_once "../padroes/cadastrosStrategy.php";
require_once "../padroes/cadastroStrategy.php";
require_once "../padroes/facade.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $senha = $_POST["senha"];
    $email = $_POST["email"];
    $data = $_POST["data"];
    $cpf = $_POST["cpf"];

    $novoUsuario = new Facade();
    $novoUsuario->cadastrarAdm($nome, $senha, $email, $data, $cpf);
}
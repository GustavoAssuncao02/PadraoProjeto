<?php
require_once "cadastrosStrategy.php";
require_once "cadastroStrategy.php";
require_once "cadastrosStrategy.php";
require_once "facade.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $senha = $_POST["senha"];
    $email = $_POST["email"];
    $data = $_POST["data"];
    $cpf = $_POST["cpf"];

    $novoUsuario = new Facade();
    $novoUsuario->cadastrarAdm($nome, $senha, $email, $data, $cpf);
}
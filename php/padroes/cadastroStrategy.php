<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "../conexao/conect.php";
require_once "AdminAuthenticationHandler.php";
require_once 'LogSingleton.php';
interface CadastroStrategy {
    public function cadastrar($nome, $senha, $email, $data, $cpf);
}

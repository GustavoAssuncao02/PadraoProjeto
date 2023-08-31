<?php
require_once "../conexao/conect.php";
require_once '../padroes/facade.php';
require_once '../padroes/LogSingleton.php';
require_once 'editarUsuario.php';
require_once "excluirUsuario.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $facade = new Facade();
    $facade->excluirUsuario($id);
    header("Location: ../index/admin_page.php?email=" . urlencode($email_usuario_autenticado));
    exit;
}
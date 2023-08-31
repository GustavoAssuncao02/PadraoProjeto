<?php
require_once "conect.php";
require_once 'facade.php';
require_once 'conect.php';
require_once 'LogSingleton.php';
require_once 'editarUsuario.php';
require_once "excluirUsuario.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $facade = new Facade();
    $facade->excluirUsuario($id);
    header("Location: admin_page.php?email=" . urlencode($email_usuario_autenticado));
    exit;
}
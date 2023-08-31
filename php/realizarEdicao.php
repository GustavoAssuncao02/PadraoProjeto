<?php
require_once "conect.php";
require_once 'facade.php';
require_once 'conect.php';
require_once 'LogSingleton.php';
require_once 'editarUsuario.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["nome"]) && isset($_POST["email"])) {
        $nomeAtualizado = $_POST["nome"];
        $emailAtualizado = $_POST["email"];
        $dataNascimentoAtualizado = $_POST["dataNascimento"];
        $senhaAtualizado = $_POST["senha"];
        $dataNascimentoAtualizado = date("Y-m-d", strtotime($dataNascimentoAtualizado));

    } else {
        header("Location: perfil_usuario.php?email=" . urlencode($email_usuario_autenticado) . "&erro=1");
        exit;
    }
} else {
    header("Location: perfil_usuario.php?email=" . urlencode($email_usuario_autenticado));
    exit;
}
$usuarioAtualizado = new Facade();
$usuarioAtualizado->editarUser($nomeAtualizado, $emailAtualizado, $dataNascimentoAtualizado, $senhaAtualizado);

?>
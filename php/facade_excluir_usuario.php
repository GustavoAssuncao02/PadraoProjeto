<?php
require_once "facade.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    
    if (Facade::excluirUsuario($id)) {
        header("Location: admin_page.php");
        exit;
    } else {
        echo "Erro ao excluir o usuário.";
    }
} else {
    header("Location: admin_page.php");
    exit;
}
?>

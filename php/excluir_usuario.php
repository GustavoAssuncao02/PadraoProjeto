<?php
require_once "conect.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $dbConnection = DatabaseConnection::getInstance()->getConnection();
    $query = "DELETE FROM projeto_final.trabalhofinal WHERE id = ?";
    $stmt = $dbConnection->prepare($query);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
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

<?php
require_once "AdminAuthenticationHandler.php";
require_once 'LogSingleton.php';
require_once "cadastrosStrategy.php";
require_once "conect.php";
require_once "facade.php";

class excluirUsuario
{
    public function excluir($id)
    {
        $dbConnection = DatabaseConnection::getInstance()->getConnection();
        $query = "DELETE FROM projeto_final.trabalhofinal WHERE id = ?";
        $stmt = $dbConnection->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
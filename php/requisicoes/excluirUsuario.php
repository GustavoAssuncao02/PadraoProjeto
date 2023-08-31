<?php
require_once "../padroes/AdminAuthenticationHandler.php";
require_once '../padroes/LogSingleton.php';
require_once "../padroes/cadastrosStrategy.php";
require_once "../conexao/conect.php";
require_once "../padroes/facade.php";

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
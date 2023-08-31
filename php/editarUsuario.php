<?php
require_once "AdminAuthenticationHandler.php";
require_once 'LogSingleton.php';
require_once "cadastrosStrategy.php";
require_once "conect.php";

class editarUsuario
{
    public function editar( $nomeAtualizado, $emailAtualizado, $dataNascimentoAtualizado, $senhaAtualizado)
    {
        $dbConnection = DatabaseConnection::getInstance()->getConnection();

        $query = "UPDATE projeto_final.trabalhofinal SET nome = ?, dataNascimento = ?, senha = ? WHERE email = ?";
        $stmt = $dbConnection->prepare($query);
        $stmt->bind_param("ssss", $nomeAtualizado, $dataNascimentoAtualizado, $senhaAtualizado, $emailAtualizado);

        $stmt->execute();


        $logInstance = LogSingleton::getInstance();
        $userId = $_SESSION['user_id'];
        $logMessage = "Usuário $userId editou o perfil: \nNome alterado para - $nomeAtualizado, \nData de nascimento alterada para - $dataNascimentoAtualizado, \nSenha alterada.";
        $logInstance->logEvent($logMessage);


        header("Location: perfil_usuario.php?email=" . urlencode($emailAtualizado));
        exit;
    }
}
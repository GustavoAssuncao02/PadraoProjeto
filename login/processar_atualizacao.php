<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["nome"]) && isset($_POST["email"])) {
        $nomeAtualizado = $_POST["nome"];
        $emailAtualizado = $_POST["email"];
        $dataNascimentoAtualizado = $_POST["dataNascimento"];
        $senhaAtualizado = $_POST["senha"];

        require_once "conect.php";
        $dbConnection = DatabaseConnection::getInstance()->getConnection();

        $query = "UPDATE projeto_final.trabalhofinal SET nome = ?, dataNascimento = ?, senha = ? WHERE email = ?";
        $stmt = $dbConnection->prepare($query);
        $stmt->bind_param("ssss", $nomeAtualizado, $dataNascimentoAtualizado, $senhaAtualizado, $emailAtualizado);
        $stmt->execute();

        
        header("Location: perfil_usuario.php?email=" . urlencode($emailAtualizado));
        exit;
    } else {
        header("Location: perfil_usuario.php?email=" . urlencode($email_usuario_autenticado) . "&erro=1");
        exit;
    }
} else {
    header("Location: perfil_usuario.php?email=" . urlencode($email_usuario_autenticado));
    exit;
}
?>
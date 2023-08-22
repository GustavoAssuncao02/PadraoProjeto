<?php
require_once "Handler.php";
class SenhaHandler extends Handler {
    public function handleRequest($email, $senha) {
        if ($this->isPasswordCorrect($email, $senha)) {
            header("Location: index_perfil.php?email=" . urlencode($email));
            exit;
        } else {
            //header("Location: cadastro.html?erro=1");
            exit;
        }
    }

    // Função para verificar se a senha está correta no banco de dados
    private function isPasswordCorrect($email, $senha) {
        $dbConnection = DatabaseConnection::getInstance()->getConnection();
        $query = "SELECT * FROM projeto_final.trabalhofinal WHERE email = ? AND senha = ?";
        $stmt = $dbConnection->prepare($query);
        $stmt->bind_param("ss", $email, $senha);
        $stmt->execute();
        $resultado = $stmt->get_result();

        return $resultado->num_rows > 0;
    }
}

<?php
require_once "Handler.php";
class EmailHandler extends Handler {
    public function handleRequest($email, $senha) {
        if ($this->emailExistsInDatabase($email)) {
            $this->successor->handleRequest($email, $senha);
        } else {

            exit;
        }
    }

    // Função para verificar se o email existe no banco de dados
    private function emailExistsInDatabase($email) {
        $dbConnection = DatabaseConnection::getInstance()->getConnection();
        $query = "SELECT * FROM projeto_final.trabalhofinal WHERE email = ?";
        $stmt = $dbConnection->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        return $resultado->num_rows > 0;
    }
}

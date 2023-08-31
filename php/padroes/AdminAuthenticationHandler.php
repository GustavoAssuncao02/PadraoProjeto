<?php
require_once "../conexao/conect.php";
interface AuthenticationHandler {
    public function setSuccessor(AuthenticationHandler $successor);
    public function handleAuthentication($email, $senha);
}

class AdminAuthenticationHandler implements AuthenticationHandler {
    public $successor;

    public function setSuccessor(AuthenticationHandler $successor) {
        $this->successor = $successor;
    }

    public function handleAuthentication($email, $senha) {
        $dbConnection = DatabaseConnection::getInstance()->getConnection();
    
        $query = "SELECT * FROM projeto_final.trabalhofinal WHERE email = ? AND senha = ?";
        $stmt = $dbConnection->prepare($query);
        $stmt->bind_param("ss", $email, $senha);
        $stmt->execute();
        $resultado = $stmt->get_result();
    
        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            if ($usuario['administrador'] == 1) {
                return "admin";
            }
        } 
        
        if ($this->successor) {
            return $this->successor->handleAuthentication($email, $senha);
        }
        
        return false;
    }
}


class UserAuthenticationHandler implements AuthenticationHandler {
    public $successor;

    public function setSuccessor(AuthenticationHandler $successor) {
        $this->successor = $successor;
    }

    public function handleAuthentication($email, $senha) {
        $dbConnection = DatabaseConnection::getInstance()->getConnection(); 

        $query = "SELECT * FROM projeto_final.trabalhofinal WHERE email = ? AND senha = ?"; 
        $stmt = $dbConnection->prepare($query);
        $stmt->bind_param("ss", $email, $senha);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();
            if ($usuario['administrador'] == 0) {
                return "user";  
            }
        }

        if ($this->successor) {
            return $this->successor->handleAuthentication($email, $senha);
        } else {
            return false; 
        }
    }
}
?>

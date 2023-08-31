<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'conect.php';
require_once 'LogSingleton.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $senha = $_POST["senha"];
    $email = $_POST["email"];
    $data = $_POST["data"];
    $cpf = $_POST["cpf"];

    // Adicione o valor padrão 0 para a coluna "administrador"
    $administrador = 0;

    $dbConnection = DatabaseConnection::getInstance();
    $conn = $dbConnection->getConnection();

    $query = "INSERT INTO projeto_final.trabalhofinal (nome, senha, email, dataNascimento, cpf, administrador) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $nome, $senha, $email, $data, $cpf, $administrador);

    $log = LogSingleton::getInstance();

    if ($stmt->execute()) {
        $log->logEvent("Novo usuário cadastrado: $nome $cpf");
        echo '<script>setTimeout(function(){ window.location.href = "../html/index.html"; }, 2000);</script>';
        exit(); 
    } else {
        $log->logEvent("Erro no cadastro: " . $stmt->error);
        echo "Erro no cadastro: " . $stmt->error;
    }
}
?>

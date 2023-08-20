<?php
require_once 'conect.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $senha = $_POST["senha"];
    $email = $_POST["email"];
    $data = $_POST["data"];
    $cpf = $_POST["cpf"];


    $dbConnection = DatabaseConnection::getInstance();

    
    $conn = $dbConnection->getConnection();

    $query = "INSERT INTO projeto_final.pjfinal (nome, senha, email, data_nascimento, cpf) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $nome, $senha, $email, $data, $cpf);

    if ($stmt->execute()) {
        // cadastro feito, entao redireciona para a pagina "index.html" após 2 segundos. tenho que arrumar
        echo '<script>setTimeout(function(){ window.location.href = "../index.html"; }, 2000);</script>';
        exit(); // para o script para evitar que seja enviada mais coisa
    } else {
        //  erro no cadastro
        echo "Erro no cadastro: " . $stmt->error;
    }
}
?>






<?php
//require_once "conect.php";

//if ($_SERVER["REQUEST_METHOD"] === "POST") {
//    $email = $_POST["email"];
//    $senha = $_POST["senha"];

//    $dbConnection = DatabaseConnection::getInstance()->getConnection();
//    $query = "SELECT * FROM projeto_final.pjfinal WHERE email = ? AND senha = ?";
//    $stmt = $dbConnection->prepare($query);
//    $stmt->bind_param("ss", $email, $senha);
//  $stmt->execute();
//$resultado = $stmt->get_result();


// if ($resultado->num_rows > 0) {
// se logar, redireciona para a pagina inial porem com perfil, ao inves na barra está "Login", vai esta "Perfil"
//   header("Location: index_perfil.php?email=" . urlencode($email));
// exit;
// } else {
// se nao logar vai voltar para a parte de cadastro 
//  header("Location: cadastro.html?erro=1");
// exit;
//}
//}





require_once "conect.php";
require_once "SenhaHandler.php";
require_once "EmailHandler.php";
require_once "Handler.php";



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $emailHandler = new EmailHandler();
    $senhaHandler = new SenhaHandler();

    $emailHandler->setSuccessor($senhaHandler);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = $_POST["email"];
        $senha = $_POST["senha"];


        $emailHandler->handleRequest($email, $senha);
        header("Location: cadastro.html");
    }

    $resultado = $stmt->get_result();
    if ($resultado->num_rows > 0) {
        header("Location: cadastro.html");
        exit;
    } else {
        header("Location: cadastro.html?erro=1");
        exit;
    }
}

?>
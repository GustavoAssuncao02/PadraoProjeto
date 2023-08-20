<?php
if (isset($_GET["email"])) {
    $email_usuario_autenticado = $_GET["email"];
} else {
    // redireciona para a pagina de login (cadastro.html) caso o email nao esteja na URL, sistema de logar com 
    //o email no URL - vê mais no (index_usuario.php)
    header("Location: cadastro.html");
    exit;
}

require_once "conect.php";
$dbConnection = DatabaseConnection::getInstance()->getConnection(); //singletoon DatabaseConnection
$query = "SELECT * FROM projeto_final.pjfinal WHERE email = ?";
$stmt = $dbConnection->prepare($query);
$stmt->bind_param("s", $email_usuario_autenticado);
$stmt->execute();
$resultado = $stmt->get_result();

// aqui que ve se tem as informações e retona no site la
// ve se tem nome, email, senha, cpf e etc e mostra no site
if ($resultado->num_rows === 1) {
    $row = $resultado->fetch_assoc();

    if (isset($row['idnome'])) {
        $idnome = $row['idnome'];
    } else {
        $idnome = "Nome não encontrado";
    }

    if (isset($row['cpf'])) {
        $cpf = $row['cpf'];
    } else {
        $cpf = "CPF não encontrado";
    }
    
    if (isset($row['data_nascimento'])) {
        $data_nascimento = $row['data_nascimento'];
    } else {
        $data_nascimento = "data_nascimento não encontrado";
    }

} else {
    // caso o usuario nao esteja cadastrado, redireciona para a pagina de login (cadastro.html)
    header("Location: cadastro.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Gustavo Assunção da Silva e Pedro Lucas N. de Aguiar">
    <link rel="stylesheet" href="../css/estiloperfil.css">
    
    <title>Perfil do Usuário</title>
</head>
<body>
   
    <div class="BarraDeNavegação">
        <div class="OpçõesBarra"><a href="index_perfil.php?email=<?php echo urlencode($email_usuario_autenticado); ?>">Home</a></div>
        <!-- botão para poder apertar no home e continuar logado, n mexer muito tava dando muito problema-->
        <div class="OpçõesBarra"><a href="#">Produtos</a></div>
        <div class="OpçõesBarra"><a href="#">Categorias</a></div>
        <div class="OpçõesBarra"><a href="#">Carrinho</a></div>
        <div class="OpçõesBarra"><a href="perfil_usuario.php?email=<?php echo urlencode($email_usuario_autenticado); ?>">Perfil</a></div>
        <!-- botão para poder apertar no perfil e continuar logado, n mexer muito tava dando muito problema-->

    </div>
    <div class="PrimeiraParte">
        <h1 class="animação">Bem-vindo ao Seu Perfil</h1>
        <div class="animação2">
            <h3>Nome de Usuário: <?php echo $idnome; ?></h3>
            <h3>E-mail de Usuário: <?php echo $email_usuario_autenticado; ?></h3>
            <h3>CPF: <?php echo $cpf; ?></h3>
            <h3>Data de Nascimento: <?php echo $data_nascimento; ?></h3>
        </div>
    </div>
</body>
</html> 

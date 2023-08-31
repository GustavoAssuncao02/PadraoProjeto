






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
        <div class="OpçõesBarra"><a href="index_perfil.php?email=<?php echo urlencode($successor); ?>">Home</a></div>
        <div class="OpçõesBarra"><a href="#">Produtos</a></div>
        <div class="OpçõesBarra"><a href="#">Categorias</a></div>
        <div class="OpçõesBarra"><a href="#">Carrinho</a></div>
        <div class="OpçõesBarra"><a href="perfil_usuario.php?email=<?php echo urlencode($successor); ?>">Perfil</a></div>
    </div>

    <div class="PrimeiraParte">
        <h1 class="animação">Perfil Administrador</h1>
        <div class="animação2">
            <table class="informacao">
                <caption><h5>Informações dos Usuários</h5></caption>
                <tr>
                    <th>Nome de Usuário</th>
                    <th>E-mail de Usuário</th>
                    <th>CPF</th>
                    <th>Data de Nascimento</th>
                    <th>Senha de Usuário</th>
                    <th>Deletar User</th>
                </tr>
                <?php
                require_once "conect.php";
                require_once "AdminAuthenticationHandler.php";
                
                $dbConnection = DatabaseConnection::getInstance()->getConnection();
                $query = "SELECT id, nome, email, cpf, dataNascimento, senha FROM projeto_final.trabalhofinal";
                $resultado = $dbConnection->query($query);

                if ($resultado->num_rows > 0) {
                    while ($row = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["nome"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["cpf"] . "</td>";
                        echo "<td>" . $row["dataNascimento"] . "</td>";
                        echo "<td>" . $row["senha"] . "</td>";
                        echo "<td><a href='realizarExclusao.php?id=" . $row["id"] . "'>Excluir</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Nenhum usuário encontrado</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
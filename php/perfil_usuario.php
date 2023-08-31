<?php
require_once "LogSingleton.php";

if (isset($_GET["email"])) {
    $email_usuario_autenticado = $_GET["email"];
} else {
    header("Location: cadastro.php");
    exit;
}

function hidePassword($password) {
    $length = strlen($password);
    return str_repeat('*', $length);
}

require_once "conect.php";
$dbConnection = DatabaseConnection::getInstance()->getConnection();
$query = "SELECT * FROM projeto_final.trabalhofinal WHERE email = ?";
$stmt = $dbConnection->prepare($query);
$stmt->bind_param("s", $email_usuario_autenticado);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $row = $resultado->fetch_assoc();
    $nome = isset($row['nome']) ? $row['nome'] : "Nome não encontrado";
    $cpf = isset($row['cpf']) ? $row['cpf'] : "CPF não encontrado";
    $senha = isset($row['senha']) ? $row['senha'] : "Senha não encontrada";
    $dataNascimento = isset($row['dataNascimento']) ? $row['dataNascimento'] : "Data de nascimento não encontrada";
} else {
    header("Location: cadastro.php");
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
        <div class="OpçõesBarra"><a href="#">Produtos</a></div>
        <div class="OpçõesBarra"><a href="#">Categorias</a></div>
        <div class="OpçõesBarra"><a href="#">Carrinho</a></div>
        <div class="OpçõesBarra"><a href="perfil_usuario.php?email=<?php echo urlencode($email_usuario_autenticado); ?>">Perfil</a></div>
    </div>

    <div class="PrimeiraParte">
        <h1 class="animação">Bem-vindo ao Seu Perfil</h1>
        <div class="animação2">
            <form id="perfilForm" method="post" action="realizarEdicao.php">
                <fieldset class="informacao">
                    <legend><h5>Informações do Usuário</h5></legend>
                    <div>
                        <h3>Nome de Usuário:</h3>
                        <h4 id="nomeUsuario" contenteditable="true"><?php echo $nome; ?></h4>
                        <button id="editarNome" type="button" class="botao-editar">Editar</button>
                    </div>
                    <div>
                        <h3>E-mail de Usuário:</h3>
                        <h4 id="emailUsuario" contenteditable="true"><?php echo $email_usuario_autenticado; ?></h4>
                    </div>
                    <div>
                        <h3>CPF:</h3>
                        <h4><?php echo $cpf; ?></h4>
                    </div>
                    <div>
                        <h3>Data de Nascimento:</h3>
                        <h4 id="dataNascimento" contenteditable="true"><?php echo $dataNascimento; ?></h4>
                        <button id="editarDataNascimento" type="button" class="botao-editar">Editar</button>
                    </div>
                    <div>
                        <h3>Senha de Usuário:</h3>
                        <h4 id="senhaUsuario" contenteditable="true"><?php echo hidePassword($senha); ?></h4>
                        <button id="editarSenha" type="button" class="botao-editar">Editar</button>
                    </div>
                </fieldset>
                <div class="btnEnviar centralizar">
                    <button type="submit" class="botao-enviar">Salvar Alterações</button>
                </div>
                <div class="btnEnviar centralizar">
                    <button type="submit" class="botao-sair">Sair</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function sair() {
            window.location.href = "../html/index.html";
        }

        document.querySelector(".botao-sair").addEventListener("click", function(event) {
            event.preventDefault();
            sair();
        });

        function habilitarEdicao(campo) {
            const elementoCampo = document.querySelector(`div h4#${campo}`);
            const elementoBotao = document.querySelector(`button#${campo}`);

            if (elementoCampo.contentEditable === "true") {
                elementoCampo.contentEditable = "false";
                elementoBotao.innerText = "Editar";
            } else {
                elementoCampo.contentEditable = "true";
                elementoCampo.focus();
                elementoBotao.innerText = "Salvar";
            }
        }

        function enviarAtualizacao() {
            const novoNome = document.getElementById("nomeUsuario").innerText;
            const novoEmail = document.getElementById("emailUsuario").innerText;
            const novoDataNascimento = document.getElementById("dataNascimento").innerText;
            const novoSenha = document.getElementById("senhaUsuario").innerText;
            const formData = new FormData();
            formData.append("nome", novoNome);
            formData.append("email", novoEmail);
            formData.append("dataNascimento", novoDataNascimento);
            formData.append("senha", novoSenha);

            fetch('realizarEdicao.php', { method: 'POST', body: formData })
                .then(response => {
                    if (response.ok) {
                        console.log("Dados atualizados com sucesso!");
                        window.location.href = "perfil_usuario.php?email=<?php echo urlencode($email_usuario_autenticado); ?>";
                    } else {
                        console.error("Erro ao atualizar os dados:", response.statusText);
                    }
                })
                .catch(error => {
                    console.error("Erro ao atualizar os dados:", error);
                });
        }

        document.querySelector("#perfilForm").addEventListener("submit", function(event) {
            event.preventDefault();
            enviarAtualizacao();
        });

        document.getElementById("editarNome").addEventListener("click", function(event) {
            habilitarEdicao("nomeUsuario");
        });

        document.getElementById("editarEmail").addEventListener("click", function(event) {
            habilitarEdicao("emailUsuario");
        });

        document.getElementById("editarDataNascimento").addEventListener("click", function(event) {
            habilitarEdicao("dataNascimento");
        });

        document.getElementById("editarSenha").addEventListener("click", function(event) {
            habilitarEdicao("senhaUsuario");
        });
    </script>
</body>
</html>

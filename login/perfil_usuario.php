<?php
if (isset($_GET["email"])) {
    $email_usuario_autenticado = $_GET["email"];
} else {
    // redireciona para a pagina de login (cadastro.html) caso o email nao esteja na URL, sistema de logar com 
    //o email no URL - vê mais no (index_usuario.php)
    header("Location: cadastro.html");
    exit;
}

function hidePassword($password) {
    $length = strlen($password);
    return str_repeat('*', $length);
}

require_once "conect.php";
$dbConnection = DatabaseConnection::getInstance()->getConnection(); //singletoon DatabaseConnection
$query = "SELECT * FROM projeto_final.trabalhofinal WHERE email = ?";
$stmt = $dbConnection->prepare($query);
$stmt->bind_param("s", $email_usuario_autenticado);
$stmt->execute();
$resultado = $stmt->get_result();

// aqui que ve se tem as informações e retona no site la
// ve se tem nome, email, senha, cpf e etc e mostra no site
if ($resultado->num_rows === 1) {
    $row = $resultado->fetch_assoc();

    if (isset($row['nome'])) {
        $nome = $row['nome'];
    } else {
        $nome = "Nome não encontrado";
    }

    if (isset($row['cpf'])) {
        $cpf = $row['cpf'];
    } else {
        $cpf = "CPF não encontrado";
    }

    if (isset($row['senha'])) {
        $senha = $row['senha'];
    } else {
        $senha = "Senha não encontrado";
    }
    
    if (isset($row['dataNascimento'])) {
        $dataNascimento = $row['dataNascimento'];
    } else {
        $dataNascimento = "dataNascimento não encontrado";
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
            <form id="perfilForm" method="post" action="processar_atualizacao.php">
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

</div>
            </form>
        </div>
    </div>

    

    <script>


//-------------------------------------------------------------------------------------função de sair do perfil
        function sair() {
            window.location.href = "../index.html";
    }
            document.querySelector(".botao-sair").addEventListener("click", function(event) {
            event.preventDefault();
            sair(); 
            });

//--------------------------------------------------------------------------------------função de poder editar as informações
        function habilitarEdicao(campo) {
            const elementoCampo = document.querySelector(`div h4#${campo}`);
            const elementoBotao = document.querySelector(`button#${campo}`);

            // ve se ta em modo de edição so que n faz muita diferença
            if (elementoCampo.contentEditable === "true") {
                // desabilita o modo de edição mas ta dando no mesmo
                elementoCampo.contentEditable = "false";
                elementoBotao.innerText = "Editar";
            } else {
                // habilita o modo de edição
                elementoCampo.contentEditable = "true";
                elementoCampo.focus();
                elementoBotao.innerText = "Salvar";
            }
        }
//---------------------------------------------------------------------------------------funçã de atualizar no bd
        function enviarAtualizacao() {
            // pega os novo valores (ja editados)
            const novoNome = document.getElementById("nomeUsuario").innerText;
            const novoEmail = document.getElementById("emailUsuario").innerText;
            const novoDataNascimento = document.getElementById("dataNascimento").innerText;
            const novoSenha = document.getElementById("senhaUsuario").innerText;

            // envia pro banco com esse "FormData"
            const formData = new FormData();
            formData.append("nome", novoNome);
            formData.append("email", novoEmail);
            formData.append("dataNascimento", novoDataNascimento);
            formData.append("senha", novoSenha);

            //manda pro "processar_atualizacao" usando o fetch pra fazer as coisas
            fetch('processar_atualizacao.php', { method: 'POST', body: formData })
                .then(response => {
                    // ve se deu certo
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

        // aqui salva as alterações quando clica no botão e manda pro bd
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
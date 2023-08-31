<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../../css/cadastroelogin.css">
</head>

<body>
  <section id="card">
    <!-- Lado do Card do Cadastro -->
    <div class="face">
      <div class="front" id="login-form">
        <h2><i>Cadastre-se Em Nosso Site</i></h2>
        <div class="character">
          <div class="eyes">
            <div class="eye"></div>
            <div class="eye"></div>
          </div>
        </div>
        <form id="formCadastro" action="" method="POST">
          <div class="username">
            <label for="nome">Nome de Cadastro</label>
            <input name="nome" id="nome" type="text" placeholder="Nome de Usuário" maxlength="20" required>
          </div>
          <div class="password">
            <label for="senha">Senha de Cadastro</label>
            <input name="senha" id="senha" type="password" placeholder="Senha" required>
          </div>
          <div class="email">
            <label for="email">E-mail de Cadastro</label>
            <input name="email" id="email" type="text" placeholder="E-mail" maxlength="50" required>
          </div>
          <div class="data">
            <label for="data">Data de Nascimento</label>
            <input name="data" id="data" type="date" placeholder="data" maxlength="20" required>
          </div>
            <div class="cpf">
              <label for="cpf">Digite o CPF:</label><br>
              <input type="text" name="cpf" id="cpf" maxlength="14" required>
            </div>
            <div class="button-container">
          <button type="submit" id="buttonCadastro" class="flex-button" formaction="../conexao/cadastroUsuario.php">Cadastrar</button>
          <button type="submit" id="buttonCadastro" formaction="../conexao/cadastroAdm.php">Cadastrar adiministrador</button></div>
        </form>
        
        <label class="cadastrar">Já é Cadastrado? Então Clique Aqui:</label>
        <button id="flipButton">Login</button>
      </div>

      <!-- Lado do Card do Login -->
      <div class="back">
        <h2 class="title"><i>Entrar na Conta</i></h2>
        <img id="imagemLogin" src="../../img/PerfilLogin.png" alt="IconLogin">
        <form id="formLogin" action="../requisicoes/realizarLogin.php" method="POST">
          <div class="usernamelog">
            <label id="title" for="nomelog">E-mail de Usuário</label>
            <br>
            <input id="nomelog" name="email" type="text" placeholder="E-mail de Usuário" maxlength="50" required>
          </div>
          <div class="passwordlog">
            <br>
            <label id="tittle2" for="senhalog">Senha de Usuário</label>
            <br>
            <input id="senhalog" name="senha" type="password" placeholder="Senha" required>
            <br>
            <div class="button-containeer">
              <button type="submit" id="buttonLogin">Entrar</button>
              <br>
              <button id="flipBackButton">Cadastre-se</button>
              <br>
              <br>
              <label class="cadastro">Se Não For Cadastrado em nosso Site <br> Clique no Botão Cadastre-se</label>

            </div>
          </div>
        </form>
      </div>
    </div>
  </section>

  <script src="../../js/script.js"></script>
</body>
</html>

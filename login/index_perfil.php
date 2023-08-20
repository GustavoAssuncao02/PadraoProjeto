<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Gustavo Assunção da Silva e Pedro Lucas N. de Aguiar">
    <link rel="stylesheet" href="../css/estilogeral.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="icon" href="../img/icon.svg">
    <title>Home</title>
</head>
<body>
    <div class="BarraDeNavegação">
        <div class="OpçõesBarra"><a id="homeLink" href="#">Home</a></div>
        <div class="OpçõesBarra"><a href="https://www.google.com.br/">Produtos</a></div>
        <div class="OpçõesBarra"><a href="https://www.google.com.br/">Categorias</a></div>
        <div class="OpçõesBarra"><a href="https://www.google.com.br/">Carrinho</a></div>
        <div class="OpçõesBarra"><a id="perfilLink" href="#">Perfil</a></div>
    </div>
    <div>
    </div>
    
    <div class="PrimeiraParte">
        <h1 class="animação">Tecnologia e Qualidade Você <br>Encontra aqui</h1>
        <div class="animação2">
            <h3>Crie sua conta para ter acesso a descontos exlcusivos</h3>
        </div>
        <img class="teclado" src="../img/telcado.png" alt="Teclado"> 
    </div>
    <div class="SegundaParte">
        <h1 class="segundaparteh2">Setups para trabalho</h1>
        <button class="Trabalho">Clique aqui</button>
    </div>
    <div class="TerceiraParte">
        <h1>a</h1>
    </div>






    <!--coloquei o javascript de quando valida o login e senha aqui pq referenciando tava dando muito problema -->
    <script>
        // pega o valor do parametro email da URL deois que valida 
        const urlParams = new URLSearchParams(window.location.search);
        const emailParam = urlParams.get('email');
    
        // faz o link de redirecionamento para "perfil_usuario.php" com o parametro email, tomar cuidado
        // com esses redirecionamento pq tava dando muito problema

        const perfilLink = document.getElementById('perfilLink');
        perfilLink.href = `perfil_usuario.php?email=${encodeURIComponent(emailParam)}`;
    
        //redireciona para a página "index.html" mantendo o parametro email meio que ainda "logado"
        function redirectToIndex() {
            window.location.href = `index.html?email=${encodeURIComponent(emailParam)}`;
        }
        
        // redirecina para "index.html"
        const homeLink = document.getElementById('homeLink');
        homeLink.href = `index.html?email=${encodeURIComponent(emailParam)}`;
    
        // deixa o botao "Home" clicavel 
        homeLink.addEventListener('click', redirectToIndex);
    </script>
</body>
</html>
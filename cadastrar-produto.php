<?php

require "src/conexao-bd.php";
require "src/Modelo/Produto.php";
require "src/Repositorio/ProdutoRepositorio.php";

if (isset($_POST['cadastro'])) {
    $imagemNome = '';
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
        $imagemNome = uniqid() . '-' . basename($_FILES['imagem']['name']);
        $imagemDiretorio = 'img/' . $imagemNome; 

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $imagemDiretorio)) {
        } else {
            echo "Erro ao mover a imagem para o diretório.";
            exit;
        }
    } else {
        echo "Erro ao enviar a imagem: " . $_FILES['imagem']['error'];
        exit;
    }

    $produto = new Produto(
        null,
        $_POST['tipo'],
        $_POST['nome'],
        $_POST['descricao'],
        (float) $_POST['preco'], 
        $imagemNome 
    );

    $produtoRepositorio = new ProdutoRepositorio($pdo);
    $produtoRepositorio->salvar($produto);

    header("Location: admin");
}

require_once("navbar.html")

?>


<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/cadastrar-produto.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>WeCoffee - Cadastrar Produto</title>
</head>

<body>
<main>
    <section class="container-admin-banner">
        <img src="img/banner.png" class="logo-admin" alt="logo-serenatto">
        <h1>Cadastro de Produtos</h1>
        <br/>
        <nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
    WeCoffee
  </a>
</nav>    </section>
    <section class="container-form">
        <form method="post" enctype="multipart/form-data">

            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Digite o nome do produto" required>
            <div class="container-radio">
                <div>
                    <label for="cafe">Café</label>
                    <input type="radio" id="cafe" name="tipo" value="Café" checked>
                </div>
                <div>
                    <label for="almoco">Doce</label>
                    <input type="radio" id="almoco" name="tipo" value="Almoço">
                </div>
            </div>
            <label for="descricao">Descrição</label>
            <input type="text" id="descricao" name="descricao" placeholder="Digite uma descrição" required>

            <label for="preco">Preço</label>
            <input type="text" id="preco" name="preco" placeholder="Digite uma descrição" required>

            <label for="imagem">Envie uma imagem do produto</label>
            <input type="file" accept="image/*" name="imagem" id="imagem" placeholder="Envie uma imagem">

            <input type="submit" name="cadastro" class="botao-cadastrar" value="Cadastrar produto"/>
        </form>
    
    </section>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js" integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="js/index.js"></script>
</body>
</html>
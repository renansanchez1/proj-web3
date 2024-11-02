<?php

require "src/conexao-bd.php";
require "src/Modelo/Produto.php";
require "src/Repositorio/ProdutoRepositorio.php";

$produtosRepositorio = new ProdutoRepositorio($pdo);
$dadosCafe = $produtosRepositorio->opcoesCafe();
$dadosAlmoco = $produtosRepositorio->opcoesAlmoco();

require_once("navbar.html");
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="img/logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>WeCoffee - Cardápio</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .container-banner {
            text-align: center;
            margin: 20px 0;
        }
        .container-cafe-manha, .container-almoco {
            margin: 30px 0;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 15px;
        }
        .container-cafe-manha-titulo, .container-almoco-titulo {
            text-align: center;
        }
        .ornaments {
            width: 100px;
            margin-top: 10px;
        }
        .container-produto {
            display: flex;
            align-items: center;
            justify-content: center; /* Centraliza horizontalmente */
            margin: 15px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            transition: box-shadow 0.3s;
        }
        .container-produto:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .container-foto {
            margin-right: 15px;
            display: flex; /* Permite centralizar a imagem */
            justify-content: center;
        }
        .container-foto img {
            max-width: 100px;
            height: auto;
            border-radius: 10px;
        }
        .produto-descricao {
            flex-grow: 1;
            text-align: left; /* Alinha o texto à esquerda */
        }
        p {
            margin: 5px 0;
        }
        h2 {
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>

<main>
    <section class="container-banner">
        <div class="container-texto-banner">
            <img src="img/banner.png" class="logo" alt="logo-serenatto">
        </div>
    </section>
    
    <h2>Cardápio Digital</h2>
    
    <section class="container-cafe-manha">
        <div class="container-cafe-manha-titulo">
            <h3>Opções de Bebidas</h3>
            <img class="ornaments" src="img/bebidas.PNG" alt="ornaments">
        </div>
        <div class="container-cafe-manha-produtos">
            <?php foreach ($dadosCafe as $cafe): ?>
                <div class="container-produto">
                    <div class="container-foto">
                        <img src="<?= $cafe->getImagemDiretorio() ?>" alt="<?= $cafe->getNome() ?>">
                    </div>
                    <div class="produto-descricao">
                        <p><strong><?= $cafe->getNome() ?></strong></p>
                        <p><?= $cafe->getDescricao() ?></p>
                        <p><?= $cafe->getPrecoFormatado() ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    
    <section class="container-almoco">
        <div class="container-almoco-titulo">
            <h3>Opções de Doces</h3>
            <img class="ornaments" src="img/doces.PNG" alt="ornaments">
        </div>
        <div class="container-almoco-produtos">
            <?php foreach ($dadosAlmoco as $almoco): ?>
                <div class="container-produto">
                    <div class="container-foto">
                        <?php 
                        $imagem = 'img/' . htmlspecialchars($almoco->getImagem());
                        if (file_exists($imagem)): ?>
                            <img src="<?php echo $imagem; ?>" alt="<?= $almoco->getNome() ?>">
                        <?php else: ?>
                            <p>Imagem não encontrada.</p>
                        <?php endif; ?>
                    </div>
                    <div class="produto-descricao">
                        <p><strong><?= $almoco->getNome() ?></strong></p>
                        <p><?= $almoco->getDescricao() ?></p>
                        <p><?= $almoco->getPrecoFormatado() ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

</body>
</html>

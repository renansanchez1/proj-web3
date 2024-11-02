<?php

require 'src/conexao-bd.php';
require 'src/Modelo/Produto.php';
require 'src/Repositorio/ProdutoRepositorio.php';

$produtoRepositorio = new ProdutoRepositorio($pdo);

if (isset($_POST['id_produto'])) {
    $idProduto = $_POST['id_produto'];
    $produto = $produtoRepositorio->buscarPorId($idProduto);
} else {
    header('Location: admin');
    exit();
}

if (isset($_POST['atualizar'])) {
    $produtoImagem = $_FILES['imagem']['name'];
    $uploadDir = 'img/';
    $uploadFile = $uploadDir . basename($produtoImagem);

    // Se uma nova imagem foi enviada
    if ($produtoImagem) {
        // Tenta mover o arquivo para o diretório especificado
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $uploadFile)) {
            // A imagem foi carregada com sucesso
            $produto = new Produto(
                $idProduto,
                $_POST['tipo'],
                $_POST['nome'],
                $_POST['descricao'],
                $_POST['preco'],
                $produtoImagem // Atualiza o caminho da nova imagem
            );
        } else {
            // Lidar com erro de upload
            echo "Erro ao fazer upload da imagem.";
            exit();
        }
    } else {
        // Caso nenhuma nova imagem tenha sido enviada, mantenha a imagem antiga
        $produto = new Produto(
            $idProduto,
            $_POST['tipo'],
            $_POST['nome'],
            $_POST['descricao'],
            $_POST['preco'],
            $produto->getImagem() // Mantém a imagem antiga
        );
    }

    $produtoRepositorio->editar($produto);
    header('Location: admin');
    exit();
}
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/update.css">
    <title>Editar Produto - WeCoffee</title>
</head>
<body>
<main>
    <h1>Editar Produto</h1>
    <div class="main-content">
        <form method="post" enctype="multipart/form-data">
            <label for="tipo">Tipo:</label>
            <input type="text" name="tipo" id="tipo" value="<?= $produto->getTipo() ?>" required>

            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="<?= $produto->getNome() ?>" required>

            <label for="descricao">Descrição:</label>
            <textarea name="descricao" id="descricao" required><?= $produto->getDescricao() ?></textarea>

            <label for="preco">Preço:</label>
            <input type="text" name="preco" id="preco" value="<?= $produto->getPreco() ?>" required>

            <label for="imagem">Imagem:</label>
            <input type="file" name="imagem" id="imagem" required>

            <input type="hidden" name="id_produto" value="<?= $produto->getId() ?>">                
            <button type="submit" name="atualizar" class="botao-atualizar">Atualizar</button>
            <a href="admin" class="botao-cancelar">Cancelar</a>
        </form>
    </div>
</main>
</body>
</html>

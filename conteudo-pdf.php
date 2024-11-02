<?php
require "src/conexao-bd.php";
require "src/Modelo/Produto.php";
require "src/Repositorio/ProdutoRepositorio.php";

$produtoRepositorio = new ProdutoRepositorio($pdo);
$produtos = $produtoRepositorio->buscarTodos();
?>

<style>
    table{
        width: 90%;
        margin: auto 0;
    }
    table, th, td{
        border: 1px solid #000;
    }

    table th{
        padding: 11px 0 11px;
        font-weight: bold;
        font-size: 18px;
        text-align: left;
        padding: 8px;
    }

    table tr{
        border: 1px solid #000;
    }

    table td{
        font-size: 18px;
        padding: 8px;
    }
    .container-admin-banner h1{
        margin-top: 40px;
        font-size: 30px;
    }
</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">WeCoffee</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="/">Home <span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="admin">Admin</a>
      <a class="nav-item nav-link" href="cadastrar">Cadastrar</a>
      <a class="nav-item nav-link disabled" href="#"></a>
    </div>
  </div>
</nav>

<table>
    <thead>
    <tr>
        <th>Produto</th>
        <th>Tipo</th>
        <th>Descricão</th>
        <th>Valor</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($produtos as $produto): ?>
        <tr>
            <td><?= $produto->getNome() ?></td>
            <td><?= $produto->getTipo() ?></td>
            <td><?= $produto->getDescricao() ?></td>
            <td><?= $produto->getPrecoFormatado() ?></td>
        </tr>
    <?php endforeach; ?>


    </tbody>
</table>

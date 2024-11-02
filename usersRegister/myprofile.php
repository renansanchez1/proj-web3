<?php
require "src/conexao-bd.php";
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['logado']) || !$_SESSION['logado']) {
    $msg = 'Você precisa estar logado para acessar esta página.';
    header('Location: login.php?msgError=' . urlencode($msg));
    exit;
}

try {
    $usuario = $_SESSION['usuario'];
    $sql = "SELECT usuario, email, data_nascimento FROM usuarios WHERE usuario = :usuario";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $user = $stmt->fetch();

    if (!$user) {
        throw new Exception('Usuário não encontrado.');
    }
} catch (PDOException $e) {
    error_log($e->getMessage());
    $msg = 'Erro ao conectar ao banco de dados. Tente novamente mais tarde!';
    header('Location: login.php?msgError=' . urlencode($msg));
    exit;
} catch (Exception $e) {
    $msg = $e->getMessage();
    header('Location: login.php?msgError=' . urlencode($msg));
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil - WeCoffee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            max-width: 600px;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 600;
            color: #333;
        }
        label {
            font-weight: 500;
            color: #555;
        }
        .form-control {
            border-radius: 10px;
            background-color: #f0f2f5;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #80bdff;
        }
        .btn-primary {
            width: 100%;
            padding: 10px;
            border-radius: 10px;
            background-color: #0275d8;
            font-weight: 600;
        }
        .btn-primary:hover {
            background-color: #025aa5;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Meu Perfil</h1>

    <?php if (isset($_GET['msgSuccess'])): ?>
        <div class="alert alert-success">
            <?php echo htmlspecialchars($_GET['msgSuccess']); ?>
        </div>
    <?php endif; ?>
    <?php if (isset($_GET['msgError'])): ?>
        <div class="alert alert-danger">
            <?php echo htmlspecialchars($_GET['msgError']); ?>
        </div>
    <?php endif; ?>

    <form action="update_profile.php" method="post">
        <div class="mb-3">
            <label for="usuario" class="form-label">Usuário:</label>
            <input type="text" id="usuario" name="usuario" class="form-control" value="<?php echo htmlspecialchars($user['usuario']); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="data_nascimento" class="form-label">Data de Nascimento:</label>
            <input type="date" id="data_nascimento" name="data_nascimento" class="form-control" value="<?php echo htmlspecialchars($user['data_nascimento']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Nova Senha:</label>
            <input type="password" id="senha" name="senha" class="form-control">
        </div>
        <div class="mb-3">
            <label for="confirmacao" class="form-label">Confirme a Nova Senha:</label>
            <input type="password" id="confirmacao" name="confirmacao" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Perfil</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

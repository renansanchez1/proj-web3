<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeCoffee - Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .login-title {
            text-align: center;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .form-label {
            font-weight: 500;
        }
        .form-control {
            border-radius: 10px;
        }
        .btn-primary {
            width: 100%;
            padding: 10px;
            font-weight: 600;
            border-radius: 10px;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #004085;
        }
        .link {
            text-align: center;
            margin-top: 10px;
        }
        .link a {
            color: #0d6efd;
            text-decoration: none;
            font-weight: 500;
        }
        .link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    
<div class="login-container">
    <h5 class="login-title">Entrar em WeCoffee</h5>
    <div class="link">
        <a href="create.php">Cadastrar usuário &gt;</a>
    </div>
    <form action="process_login.php" method="post">
        <div class="mb-3">
            <label for="usuario" class="form-label">Usuário</label>
            <input type="text" name="usuario" id="usuario" class="form-control" value="<?php echo !empty($_POST['usuario']) ? htmlspecialchars($_POST['usuario']) : '' ?>">
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" name="senha" id="senha" class="form-control">
        </div>
        <div class="d-grid">
            <input type="submit" value="Entrar" class="btn btn-primary">
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-DBA2R0x6y6z47eQ6i6xGwlF9FJ5E7y4XfRyy8C5IwiRzDF5ZoIbiUPFgybP6aF6M" crossorigin="anonymous"></script>
</body>
</html>

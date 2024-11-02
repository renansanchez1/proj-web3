<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>WeCoffee - Cadastro</title>
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
    <h5 class="login-title">Cadastro em WeCoffee</h5>
    <div class="link">
        <a href="login.php">Mudar para entrada de usuário &gt;</a>
    </div>
    <form action="process_create.php" method="post">
        <div class="mb-3">
            <label for="usuario" class="form-label">Usuário</label>
            <input type="text" class="form-control" name="usuario" id="usuario">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="text" class="form-control" name="email" id="email">
        </div>
        <div class="mb-3">
            <label for="data_nascimento" class="form-label">Data de nascimento</label>
            <input type="date" class="form-control" name="data_nascimento" id="data_nascimento">
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" name="senha" id="senha">
        </div>
        <div class="mb-3">
            <label for="confirmacao" class="form-label">Confirmação de senha</label>
            <input type="password" class="form-control" name="confirmacao" id="confirmacao">
        </div>
        <div class="d-grid">
            <input type="submit" value="Cadastrar" class="btn btn-primary">
        </div>
    </form>
</div>

</body>
</html>

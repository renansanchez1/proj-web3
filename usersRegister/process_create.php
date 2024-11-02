
<?php
require "src/conexao-bd.php";

try {
    if (!empty($_POST)) {
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
        $confirmacao = $_POST['confirmacao'];
        $email = $_POST['email'];
        $data_nascimento = $_POST['data_nascimento'];

        if ($senha !== $confirmacao) {
            $msg = 'As senhas não conferem. Tente novamente!';
            header('Location: list.php?msgError=' . urlencode($msg));
            exit;
        }

        // Hash da senha
        $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

        $sql = "INSERT INTO usuarios (usuario, senha, email, data_nascimento) VALUES (:usuario, :senha, :email, :data_nascimento)";

        $stmt = $conexao->prepare($sql);

        $stmt->bindValue(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->bindValue(':senha', $senhaHash, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':data_nascimento', $data_nascimento, PDO::PARAM_STR);

        // Executa a declaração
        if ($stmt->execute()) {
            $msg = 'Usuário cadastrado com sucesso!';
            header('Location: login.php?msgSuccess=' . urlencode($msg));
        } else {
            $msg = 'Falha ao cadastrar usuário. Tente novamente mais tarde!';
            header('Location: login.php?msgError=' . urlencode($msg));
        }
    } else {
        $msg = 'Você precisa preencher o formulário.';
        header('Location: login.php?msgError=' . urlencode($msg));
    }
} catch (PDOException $e) {
    error_log($e->getMessage());
    $msg = 'Falha ao conectar ao banco de dados. Tente novamente mais tarde!';
    header('Location: login.php?msgError=' . urlencode($msg));
}
?>

<?php
require "src/conexao-bd.php";
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['logado']) || !$_SESSION['logado']) {
    $msg = 'Você precisa estar logado para acessar esta página.';
    header('Location: login.php?msgError=' . urlencode($msg));
    exit;
}

try {
    // Obtém o nome de usuário da sessão
    $usuario = $_SESSION['usuario'];

    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $data_nascimento = $_POST['data_nascimento'];
        $senha = $_POST['senha'];
        $confirmacao = $_POST['confirmacao'];

        // Verifica se as senhas conferem
        if (!empty($senha) || !empty($confirmacao)) {
            if ($senha !== $confirmacao) {
                $msg = 'As senhas não conferem. Tente novamente!';
                header('Location: myprofile.php?msgError=' . urlencode($msg));
                exit;
            }

            // Hash da senha
            $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

            // Atualiza o usuário com nova senha e dados
            $sql = "UPDATE usuarios SET email = :email, data_nascimento = :data_nascimento, senha = :senha WHERE usuario = :usuario";
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':senha', $senhaHash, PDO::PARAM_STR);
        } else {
            // Atualiza o usuário sem alterar a senha
            $sql = "UPDATE usuarios SET email = :email, data_nascimento = :data_nascimento WHERE usuario = :usuario";
            $stmt = $conexao->prepare($sql);
        }

        $stmt->bindValue(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':data_nascimento', $data_nascimento, PDO::PARAM_STR);

        if ($stmt->execute()) {
            // Redefine a sessão do usuário se a senha foi alterada
            if (!empty($senha)) {
                session_unset(); // Remove todas as variáveis de sessão
                session_destroy(); // Destroi a sessão
                $msg = 'Perfil atualizado com sucesso. Por favor, faça login novamente.';
            } else {
                $msg = 'Perfil atualizado com sucesso!';
            }
            header('Location: myprofile.php?msgSuccess=' . urlencode($msg));
            exit; 
        } else {
            $msg = 'Falha ao atualizar perfil. Tente novamente mais tarde!';
            header('Location: myprofile.php?msgError=' . urlencode($msg));
            exit;
        }
    } else {
        $msg = 'Você precisa preencher o formulário.';
        header('Location: myprofile.php?msgError=' . urlencode($msg));
        exit;
    }
} catch (PDOException $e) {
    error_log($e->getMessage());
    $msg = 'Falha ao conectar ao banco de dados. Tente novamente mais tarde!';
    header('Location: myprofile.php?msgError=' . urlencode($msg));
    exit;
}
?>

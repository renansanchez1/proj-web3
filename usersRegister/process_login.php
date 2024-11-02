<?php
require "src/conexao-bd.php";
session_start(); 

try {
    if (!empty($_POST['usuario']) && !empty($_POST['senha'])) {

        
        $sql = "SELECT usuario, senha FROM usuarios WHERE usuario = :usuario";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(':usuario', $_POST['usuario'], PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();

        if ($result) {
            // Verifica a senha
            if (password_verify($_POST['senha'], $result['senha'])) {
                // Senha está correta, cria a sessão do usuário
                $_SESSION['usuario'] = $result['usuario']; 
                $_SESSION['logado'] = true; // Flag para verificar se o usuário está logado

                $msg = 'Autenticação realizada com sucesso!';
                header('Location: ../list.php'); 
                exit;
            } else {
                $msg = 'Senha incorreta!';
                header('Location: login.php?msgError=' . urlencode($msg));
                exit;
            }
        } else {
            $msg = 'Usuário não encontrado!';
            header('Location: login.php?' . urlencode($msg));
            exit;
        }
    } else {
        $msg = 'Você precisa preencher todos os campos!';
        header('Location: login.php?msgError=' . urlencode($msg));
        exit;
    }
} catch (PDOException $e) {
    error_log($e->getMessage());
    $msg = 'Erro ao conectar ao banco de dados. Tente novamente mais tarde!';
    header('Location: login.php?msgError=' . urlencode($msg));
    exit;
}
?>

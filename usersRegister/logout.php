<?php
session_start(); // Inicia a sessão
session_destroy(); // Destroi a sessão atual
header('Location: login.php?msgSuccess=' . urlencode('Logout realizado com sucesso!')); // Redireciona para a página de login
exit;
?>

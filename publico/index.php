<?php
if (!array_key_exists('PATH_INFO', $_SERVER) || $_SERVER["PATH_INFO"] == "/") {
    require_once(__DIR__ . "/../pagina-inicial.php");
} else if ($_SERVER["PATH_INFO"] == "/admin") {
    require_once(__DIR__ . "/../admin.php");
} else if ($_SERVER["PATH_INFO"] == "/cadastrar") {
    require_once(__DIR__ . "/../cadastrar-produto.php");
} else if ($_SERVER["PATH_INFO"] == "/excluir") {
    require_once(__DIR__ . "/../excluir.php");
} else if ($_SERVER["PATH_INFO"] == "/relatorio") {
    require_once(__DIR__ . "/../gerador-pdf.php");
}
else if ($_SERVER["PATH_INFO"] == "/editar") {
    require_once(__DIR__ . "/../editar-produto.php");
}

?>

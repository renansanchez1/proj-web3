<?php

/**
 * https://packagist.org/ - Local padrão de dependências do PHP
 * pesquisar por dompdf/dompdf
 * Instalação:  composer requiredompdf/dompdf
 */

require "vendor/autoload.php";

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

/**
 * ob_start() inicia um buffer de saída
 */
ob_start();
require "conteudo-pdf.php";
/**
 * ob_get_clean() Pega o conteúdo renderizado e atribui na variável $html e limpa o buffer
 */
$html = ob_get_clean();

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();
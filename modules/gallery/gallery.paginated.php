<?php

$html = !isset($manage) ? '<section class="py-5" id="section-gallery">' : '';
$html .= ' <div class="container">';

// Galería
require_once("gallery.php");
// Paginación
require_once("gallery.pagination.php");

// Cierre
$html .= !isset($manage) ? '</section>' : '';
$html .= '</div>';

// Imprimir el HTML generado
echo $html;

?>

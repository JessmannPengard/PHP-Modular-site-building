<?php

// Requires
require_once("modules/database/database.php");
require_once("gallery.model.php");
require_once("gallery.config.php");

// Número de página e imágenes por página
$page = isset($_GET['gallery-page']) ? (int) $_GET['gallery-page'] : 1;
$perPage = PICS_PER_PAGE;

// Conexión a la base de datos
$db = new Database;

// Instancia Gallery
$gallery = new Gallery($db->getConnection());

// Obtener las imágenes de la página actual
$images = $gallery->getImages($page, $perPage);

// Construir el HTML de la galería
$html .= '<h2 class="text-center mb-4 section-title">Galería</h2>';
$html .= '<ul class="gallery">';
foreach ($images as $image) {

    $html .= '<li class="image-container">';
    $html .= '<img src="' . $image['url_picture'] . '" class="card-img-top">';
    // Overlay para el lightbox
    $html .= '<div class="image-overlay"></div>';
    $html .= '</li>';

}
$html .= '</ul>';

?>

<!-- Estilos -->
<link rel="stylesheet" href="modules/gallery/gallery.css">
<!-- Script -->
<script src="modules/gallery/gallery.js"></script>
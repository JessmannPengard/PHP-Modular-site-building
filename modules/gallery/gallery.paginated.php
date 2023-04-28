<?php

$html = ' <div class="container">';

// Galería
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
$html .= '<h2 class="text-center mb-4 section-title" data-i18n="gallery">Gallery</h2>';
$html .= '<ul class="gallery">';
foreach ($images as $image) {

    $html .= '<li class="image-container">';
    $html .= '<img src="' . $image['url_picture'] . '" class="card-img-top">';
    // Overlay para el lightbox
    $html .= '<div class="image-overlay"></div>';
    $html .= '</li>';

}
$html .= '</ul>';

// Paginación:

// Obtener el número total de imágenes
$total = $gallery->getCount();

// Construir la navegación de la paginación
$html .= '<nav aria-label="Page navigation">';
$html .= '<ul class="pagination justify-content-center">';
$numPages = ceil($total / $perPage);
// Botón Anterior
if ($page > 1) {
    $html .= '<li class="page-item">
                <a class="page-link" href="?gallery-page=' . $page - 1 . '" aria-label="Anterior">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>';
}
for ($i = 1; $i <= $numPages; $i++) {
    $active = ($i == $page) ? ' active' : '';
    $html .= '<li class="page-item' . $active . '"><a class="page-link" href="?gallery-page=' . $i . '">' . $i . '</a></li>';
}
// Botón siguiente
if ($page < $numPages) {
    $html .= '<li class="page-item">
                <a class="page-link" href="?gallery-page=' . $page + 1 . '" aria-label="Anterior">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>';
}
$html .= '</ul>';
$html .= '</nav>';

// Cierre
$html .= '</div>';

echo '<!-- Estilos -->';
echo '<link rel="stylesheet" href="modules/gallery/gallery.css">';
echo '<!-- Script -->';
echo '<script src="modules/gallery/gallery.js"></script>';

// Imprimir el HTML generado
echo $html;

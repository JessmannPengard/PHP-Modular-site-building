<?php

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

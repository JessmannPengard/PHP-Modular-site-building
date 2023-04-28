<!-- Gallery module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<?php
// Config file
require_once("modules/gallery/gallery.config.php");
?>

<!-- Section gallery: start -->
<section class="container" id="section-gallery">

    <!-- Gallery heading: start -->
    <h2 class="h1 font-weight-bold text-center my-4" data-i18n="gallery">Gallery</h2>
    <!-- Gallery heading: end -->

    <div class="row" id="gallery-container"></div>

    <!-- Construir la navegación de la paginación -->
    <nav aria-label="Page navigation">

        <ul class="pagination justify-content-center" id="pagination container"></ul>

    </nav>

</section>

<!-- Styles -->
<link rel="stylesheet" href="modules/gallery/gallery.css">

<script>
    // Lista de imágenes
    var imageList = [];
    // Contenedor de las imágenes
    var galleryContainer = document.getElementById("gallery-container");
    var paginationContainer = document.getElementById("pagination-container");

    // Función para cargar la lista de imágenes
    function cargarLista() {
        fetch('modules/gallery/gallery.getList.php')
            .then(response => response.json())
            .then(data => {
                imageList = data;
                // Cargar las primeras
                showGalleryPage(1);
            })
            .catch(error => console.error(error));
    }

    function showGalleryPage(numPage) {
        start = (numPage - 1) * <?= PICS_PER_PAGE ?>;
        end = start + <?= PICS_PER_PAGE ?>;
        pics = imageList.slice(start, end);

        galleryContainer.innerHTML = "";
        pics.forEach(element => {
            galleryContainer.innerHTML += generarHtmlImagen(element["url_picture"]);
        });
        galleryContainer.innerHTML += buildHtmlPagination();
        addLightbox();
    }

    // Genera el HTML de una imagen
    function generarHtmlImagen(url_picture) {
        html_imagen = '<div class="col-md-4 mb-3">';
        html_imagen += '<div class="card">';
        html_imagen += '<div class="image-container">';
        html_imagen += '<img src="' + url_picture + '" class="card-img-top">';
        // Overlay para el lightbox
        html_imagen += '<div class="image-overlay"></div>';
        html_imagen += '</div></div></div>';
        return html_imagen;
    }

    // Generar HTML paginación
    function buildHtmlPagination() {
        // Obtener el número total de imágenes
        total = imageList.length;
        numPages = Math.floor(total / <?= PICS_PER_PAGE ?>);

        html = '';
        // Página Anterior
        if (numPages > 1) {
            html += '<li class="page-item"><a class="page-link" href="" aria-label="Anterior"><span aria-hidden="true">&laquo;</span></a></li>';
        }

        // Páginas
        for (i = 1; i <= numPages; i++) {
            html += '<li class="page-item"><a class="page-link" href="">' + i + '</a></li>';
        }

        // Página siguiente
        if (numPages > 1) {
            html += '<li class="page-item"><a class="page-link" href="" aria-label="Anterior"><span aria-hidden="true">&raquo;</span></a></li>';
        }
        return html;
    }

    // Añadir el lightbox a las imágenes
    function addLightbox() {
        const imageContainers = document.querySelectorAll('.image-container');
        imageContainers.forEach((container) => {
            container.addEventListener('click', () => {
                const rutaImagen = container.querySelector('img').getAttribute('src');
                const lightbox = `<div class="lightbox">
                                    <img src="${rutaImagen}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="close-lb"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg>
                              </div>`;
                document.querySelector('body').insertAdjacentHTML('beforeend', lightbox);
                const cerrar = document.querySelector('.close-lb');
                cerrar.addEventListener('click', (e) => {
                    e.preventDefault();
                    const lightbox = document.querySelector('.lightbox');
                    lightbox.parentNode.removeChild(lightbox);
                });
            });
        });
    }

    cargarLista();

</script>
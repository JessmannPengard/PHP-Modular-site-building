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


</section>


<!-- Styles -->
<link rel="stylesheet" href="modules/gallery/gallery.css">

<script>
    // Lista de imágenes
    var imageList = [];
    // Contenedor de las imágenes
    var galleryContainer = document.getElementById("gallery-container");
    // Contador de las imágenes mostradas
    var imageCount = 0;

    // Función para cargar la lista de imágenes
    function cargarLista() {
        fetch('modules/gallery/gallery.getList.php')
            .then(response => response.json())
            .then(data => {
                imageList = data;
                // Cargar las primeras
                cargarPrimeras();
            })
            .catch(error => console.error(error));
    }

    // Función para cargar las primeras imágenes
    function cargarPrimeras() {
        for (var i = 0; i < <?= PICS_PER_PAGE ?>; i++) {
            galleryContainer.innerHTML += generarHtmlImagen(imageList[i]["url_picture"]);
            imageCount++;
            addLightbox();
        }
    }

    // Cargamos la lista de imágenes
    cargarLista();

    // Al llegar al final de la página cargamos más imágenes si hay
    window.addEventListener("scroll", function () {
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
            for (var i = 0; i < <?= PICS_PER_PAGE ?>; i++) { // cargamos las siguientes imágenes
                if (imageCount < imageList.length) { // comprobamos que aún quedan imágenes por cargar
                    galleryContainer.innerHTML += generarHtmlImagen(imageList[imageCount]["url_picture"]);
                    imageCount++;
                    addLightbox();
                }
            }
        }
    });

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
</script>
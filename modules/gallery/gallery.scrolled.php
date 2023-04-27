<script>
    $(document).ready(function () {
        // Lista de imágenes
        var imageList = [];
        // Contenedor de las imágenes
        var galleryContainer = document.getElementById("gallery-container");
        // Contador de las imágenes mostradas
        var imageCount = 0;
        // Modo administración
        manage = <?= $manage ?>;

        // Al llegar al final de la página cargamos más imágenes si hay
        window.addEventListener("scroll", function () {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
                for (var i = 0; i < 6; i++) { // cargamos las siguientes imágenes
                    if (imageCount < imageList.length) { // comprobamos que aún quedan imágenes por cargar
                        html_imagen = '<div class="col-md-4 mb-3">';
                        html_imagen += '<div class="card">';
                        html_imagen += '<div class="image-container">';
                        html_imagen += '<img src="' + imageList[imageCount]["url_picture"] + '" class="card-img-top">';
                        // Overlay para el lightbox
                        html_imagen += '<div class="image-overlay"></div>';
                        html_imagen += '</div>';

                        // Mostramos los controles de administración si estamos en ese modo
                        if (manage) {
                            html_imagen += '<div class="card-body"><a href="" data-toggle="modal" data-target="#confirmacionModal" class="delete-pic" id='
                                + imageList[imageCount]["id"] + '><i class="fas fa-trash"></i></a></div>';
                        }
                        html_imagen += '</div></div>';
                        galleryContainer.innerHTML += html_imagen;
                        imageCount++;
                    }
                }
            }
        });

        // Función para cargar la lista de imágenes
        function cargarLista() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    imageList = JSON.parse(this.responseText);
                    // Cargar las primeras
                    cargarPrimeras();
                }
            };
            xhttp.open("GET", "./modules/gallery/gallery.scrolled.getList.php", true);
            xhttp.send();
        }

        // Función para cargar las primeras imágenes
        function cargarPrimeras() {
            for (var i = 0; i < 6; i++) {
                html_imagen += '<div class="image-container">';
                html_imagen += '<img src="' + imageList[i]["url_picture"] + '" class="card-img-top">';
                // Overlay para el lightbox
                html_imagen += '<div class="image-overlay"></div>';
                html_imagen += '</div>';
                galleryContainer.innerHTML += html_imagen;
                imageCount++;
            }
        }

        // Cargamos la lista de imágenes
        cargarLista();
    });
</script>

<?php
echo !isset($manage) ? '<section class="py-5" id="section-gallery">' : '';
echo '<div class="container">';
echo '<h2 class="text-center mb-4 section-title">Galería</h2>';
?>

<div class="row" id="gallery-container"></div>

<?php
// Cierre
echo !isset($manage) ? '</section>' : '';
echo '</div>';
?>

<!-- Estilos -->
<link rel="stylesheet" href="./modules/gallery/gallery.css">
<!-- Script -->
<script src="./modules/gallery/gallery.js"></script>
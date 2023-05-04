<!-- Gallery (scrolled) module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<?php
// Config file
require_once("modules/gallery/gallery.config.php");
?>

<!-- Section gallery: start -->
<section class="container" id="section-gallery">

    <!-- Gallery heading: start -->
    <h2 class="h1 font-weight-bold text-center my-4">
        <?= $lang["gallery"] ?>
    </h2>
    <!-- Gallery heading: end -->

    <!-- Gallery container: start -->
    <div class="row" id="gallery-container"></div>
    <!-- Gallery container: end -->

</section>
<!-- Section gallery: end -->

<!-- Script: start -->
<script>
    // List of images
    var imageList = [];
    // Images container
    var galleryContainer = document.getElementById("gallery-container");
    // Counter for showed images
    var imageCount = 0;

    // Load list of images
    function loadList() {
        fetch('modules/gallery/gallery.getList.php')
            .then(response => response.json())
            .then(data => {
                imageList = data;
                // Cargar las primeras
                loadFirst();
            })
            .catch(error => console.error(error));
    }

    // Load first images
    function loadFirst() {
        for (var i = 0; i < <?= PICS_PER_PAGE ?>; i++) {
            galleryContainer.innerHTML += generateHtmlImage(imageList[i]["url_picture"]);
            imageCount++;
            addLightbox();
        }
    }

    // Load images list
    loadList();

    // Load more images on scroll
    window.addEventListener("scroll", function () {
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
            for (var i = 0; i < <?= PICS_PER_PAGE ?>; i++) { // load next images
                if (imageCount < imageList.length) { // check for more images to load
                    galleryContainer.innerHTML += generateHtmlImage(imageList[imageCount]["url_picture"]);
                    imageCount++;
                    addLightbox();
                }
            }
        }
    });

    // Generate HTML for an image
    function generateHtmlImage(url_picture) {
        html = '<div class="col-md-4 mb-3">';
        html += '<div class="card">';
        html += '<div class="image-container">';
        html += '<img src="' + url_picture + '" class="card-img-top">';
        // Overlay for the lightbox
        html += '<div class="image-overlay"></div>';
        html += '</div></div></div>';
        return html;
    }


    // Add lightbox to images
    function addLightbox() {
        const imageContainers = document.querySelectorAll('.image-container');
        imageContainers.forEach((container) => {
            container.addEventListener('click', () => {
                const urlPic = container.querySelector('img').getAttribute('src');
                const lightbox = `<div class="lightbox">
                                    <img src="${urlPic}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="close-lb"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M310.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L160 210.7 54.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L114.7 256 9.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 301.3 265.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L205.3 256 310.6 150.6z"/></svg>
                              </div>`;
                document.querySelector('body').insertAdjacentHTML('beforeend', lightbox);
                const closeBtn = document.querySelector('.close-lb');
                closeBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    const lightbox = document.querySelector('.lightbox');
                    lightbox.parentNode.removeChild(lightbox);
                });
            });
        });
    }
</script>
<!-- Script: end -->

<!-- Styles: start -->
<link rel="stylesheet" href="modules/gallery/gallery.css">
<!-- Styles: end -->
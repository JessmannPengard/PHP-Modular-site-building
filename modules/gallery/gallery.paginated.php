<!-- Gallery (paginated) module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

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

    <!-- Images container: start -->
    <div class="row" id="gallery-container"></div>
    <!-- Pictures container: end -->

    <!-- Page navigation: start -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center" id="pagination-container"></ul>
    </nav>
    <!-- Page navigation: end -->

</section>
<!-- Section gallery: end -->

<!-- Script: start -->
<script>
    // Image list
    var imageList = [];
    // Image container
    var galleryContainer = document.getElementById("gallery-container");
    // Pagination container
    var paginationContainer = document.getElementById("pagination-container");
    // Current page
    var currentPage = 1;
    // Total images
    total = 0;
    // Number of pages
    numPages = 0;

    // Load images list
    function loadImageList() {
        fetch('modules/gallery/gallery.getList.php')
            .then(response => response.json())
            .then(data => {
                imageList = data;
                // Cargar las primeras
                showGalleryPage(1);
            })
            .catch(error => console.error(error));
    }

    // Show numPage from Gallery
    function showGalleryPage(numPage) {
        // Get images from selected page
        start = (numPage - 1) * <?= PICS_PER_PAGE ?>;
        end = start + <?= PICS_PER_PAGE ?>;
        pics = imageList.slice(start, end);

        // Clean gallery container
        galleryContainer.innerHTML = "";

        // Place images
        pics.forEach(element => {
            galleryContainer.innerHTML += buildHtmlImage(element["url_picture"]);
        });
        // Place pagination
        paginationContainer.innerHTML = buildHtmlPagination();

        // Add lightbox to images
        addLightbox();

        // Add event control to pagination buttons
        eventPageButtons();
    }

    // Generate HTML for an image
    function buildHtmlImage(url_picture) {
        html = '<div class="col-md-4 mb-3">';
        html += '<div class="card">';
        html += '<div class="image-container">';
        html += '<img src="' + url_picture + '" class="card-img-top">';
        // Overlay for the lightbox
        html += '<div class="image-overlay"></div>';
        html += '</div></div></div>';
        return html;
    }

    // Generate HTML pagination
    function buildHtmlPagination() {
        // Get total number of images
        total = imageList.length;
        // Calculate number o pages
        numPages = Math.ceil(total / <?= PICS_PER_PAGE ?>);

        html = '';
        // Previous page
        if (numPages > 1) {
            html += '<li class="page-item"><button class="page-link" aria-label="Previous" data-control="prev"><span aria-hidden="true">&laquo;</span></button></li>';
        }

        // Pages
        for (i = 1; i <= numPages; i++) {
            var activeClass = i == currentPage ? 'active' : '';
            html += '<li class="page-item"><button class="page-link ' + activeClass + '">' + i + '</button></li>';
        }

        // Next page
        if (numPages > 1) {
            html += '<li class="page-item"><button class="page-link" aria-label="Next" data-control="next"><span aria-hidden="true">&raquo;</span></button></li>';
        }
        return html;
    }

    // Add event to pagination buttons
    function eventPageButtons() {
        var buttons = document.getElementsByClassName("page-link");
        Array.prototype.forEach.call(buttons, function (button) {
            button.onclick = function () {
                switch (this.dataset.control) {
                    case "prev":
                        if (currentPage > 1) currentPage--;
                        break;
                    case "next":
                        if (currentPage < numPages) currentPage++;
                        break;
                    default:
                        currentPage = this.innerHTML;
                        break;
                }
                showGalleryPage(currentPage);
            }
        });
    }

    // Adds lightbox to images
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

    // Load image list
    loadImageList();

</script>
<!-- Script: end -->

<!-- Styles: start -->
<link rel="stylesheet" href="modules/gallery/gallery.css">
<!-- Styles: end -->
document.addEventListener("DOMContentLoaded", function () {

    // Obtener el parámetro de página de la URL
    var urlParams = new URLSearchParams(window.location.search);
    var pageParam = urlParams.get('gallery-page');
    // Si el parámetro de página está presente, dirigir la página a la sección de galería
    if (pageParam) {
        // Obtener el elemento de la sección de galería
        var gallerySection = document.getElementById('section-gallery');
        // Establecer la posición de desplazamiento al elemento de la sección de galería
        if (!gallerySection == null) {
            gallerySection.scrollIntoView({ block: 'start', behavior: 'instant' });
        }
    };


    // Al clicar en el botón de borrar cambiamos el enlace para borrar
    // la imagen seleccionada si el usuario confirma el borrado
    const deletePicButtons = document.querySelectorAll('.delete-pic');
    let idImagenBorrar;
    deletePicButtons.forEach((button) => {
        button.addEventListener('click', () => {
            idImagenBorrar = button.getAttribute('id');
            const confirmDelete = document.querySelector('#confirm-delete');
            confirmDelete.setAttribute('href', `./modules/gallery/gallery.delete.php?id=${idImagenBorrar}`);
        });
    });

    // Previsualizar las imágenes al subirlas,
    // cuando cambia el valor del campo de imagen
    const imagenInput = document.querySelector('#imagen');
    const previsualizacion = document.querySelector('#previsualizacion');
    const previsualizarImg = document.querySelector('#previsualizarImg');
    const file = document.querySelector('#file');
    if (imagenInput != null) {
        imagenInput.addEventListener('change', () => {
            const archivo = imagenInput.files[0];
            if (archivo) {
                const lector = new FileReader();
                lector.onload = function (e) {
                    previsualizacion.setAttribute('src', e.target.result);
                    previsualizarImg.classList.remove('d-none');
                    file.classList.remove('d-none');
                }
                lector.readAsDataURL(archivo);
            }
        });
    }

    // Mostrar el lightbox al hacer click en las imágenes
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

});

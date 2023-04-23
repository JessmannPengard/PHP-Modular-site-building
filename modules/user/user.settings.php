<?php
// Autorización se sesión
require("user.authsession.php");

// Importamos los módulos necesarios
require_once("../../config/app.php");
require_once("../../modules/database/database.php");
require_once("user.model.php");

// Inicializamos la variable que usaremos para mostrar mensajes en caso de algún error
$msg = "empty";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="../../vendor/bootstrap/css/bootstrap.css">
    <!-- Script de idiomas -->
    <script src="../../modules/translations/translations.js"></script>
    <!--Estilos-->
    <link rel="stylesheet" href="user.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../../favicon.ico">
    <!-- Título de la página -->
    <title>
        <?= BRAND ?>
    </title>
</head>

<body>
    <!-- Encabezado de página -->
    <?php
    require_once("../nav/nav.lite.php");
    ?>

    <section class="w-100 p-4" id="section-profile">
        <!-- Título -->
        <h2 data-i18n="settings">Settings</h2>

        <div class="row">
            <!-- Menu -->
            <div class="col-lg-4">
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="" class="nav-link link-dark active" data-target="account-settings" data-i18n="account">
                            <svg xmlns="http://www.w3.org/2000/svg" class="settings-icon"
                                viewBox="0 0 448 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path
                                    d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                            </svg>
                            Account
                        </a>
                    </li>
                    <li>
                        <a href="" class="nav-link link-dark" data-target="account-password" data-i18n="password">
                            <svg xmlns="http://www.w3.org/2000/svg" class="settings-icon"
                                viewBox="0 0 448 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path
                                    d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z" />
                            </svg>
                            Password
                        </a>
                    </li>
                    <li>
                        <a href="" class="nav-link link-dark" data-target="account-preferences" data-i18n="preferences">
                            <svg xmlns="http://www.w3.org/2000/svg" class="settings-icon"
                                viewBox="0 0 512 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path
                                    d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z" />
                            </svg>
                            Preferences
                        </a>
                    </li>
                    <li>
                        <a href="" class="nav-link link-dark" data-target="account-delete" data-i18n="delete account">
                            <svg xmlns="http://www.w3.org/2000/svg" class="settings-icon"
                                viewBox="0 0 448 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path
                                    d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z" />
                            </svg>
                            Delete account
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-8">
                <!-- Account -->
                <div class="card mb-4" id="account-settings">
                    <form action="" method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0" data-i18n="username">Username</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" name="username" class="form-control" maxlength=50
                                                required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0" data-i18n="email">Email</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="email" name="email" class="form-control" maxlength=50 required>
                                        </div>
                                    </div>
                                    <br>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="d-flex justify-content-center mb-2">
                                                <button type="submit" class="btn btn-primary"
                                                    data-i18n="save changes">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card-body text-center">
                                        <img src="../../img/portrait.png" alt="avatar" class="rounded-circle img-fluid"
                                            id="settings-profile-picture">
                                        <div class="d-flex justify-content-center mb-2">
                                            <small data-i18n="click to change">Click to change</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Password -->
                <div class="card mb-4" id="account-password" hidden>
                    <form action="" method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0" data-i18n="current password">Current password</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="password" name="current-password" class="form-control"
                                                maxlength=50 required>
                                            <small>
                                                <a href="user.passwordrecovery.php" class="user-link"
                                                    data-i18n="forgot password">He
                                                    olvidado mi
                                                    contraseña</a>
                                            </small>
                                        </div>

                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0" data-i18n="new password">New password</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="password" name="password" id="password" class="form-control"
                                                maxlength=50 required>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0" data-i18n="repeat password">Repeat password</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="password" name="r-password" id="r-password"
                                                class="form-control" maxlength=50 required>
                                        </div>
                                        <!-- Mostramos el mensaje de error, si lo hubiera -->
                                        <div class="form-group">
                                            <p class="form-error" id="error" data-i18n="<?= $msg ?>"></p>
                                        </div>
                                    </div>
                                    <br>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="d-flex justify-content-center mb-2">
                                                <button type="submit" class="btn btn-primary"
                                                    data-i18n="save changes">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>



                <!-- Preferences -->
                <div class="card mb-4" id="account-preferences" hidden>
                    <form action="" method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="mb-0" data-i18n="language">Language</p>

                                            <li class="nav-item dropdown">
                                                <a class="dropdown-toggle" href="#" role="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img src="../nav/img/flag-great-britain.png" alt=""
                                                        class="menu-icon" id="language-selected-image">
                                                    <span id="language-selected-name">English</span>
                                                </a>

                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li class="language-item" data-language-id="en">
                                                        <a class="dropdown-item" href="#">
                                                            <img src="../nav/img/flag-great-britain.png" alt=""
                                                                class="menu-icon">
                                                            <span>English</span>
                                                            <span id="language-selected-icon">&#x2714;</span>
                                                        </a>
                                                    </li>
                                                    <li class="language-item" data-language-id="es">
                                                        <a class="dropdown-item" href="#">
                                                            <img src="../nav/img/flag-spain.png" alt=""
                                                                class="menu-icon">
                                                            <span>Español</span></a>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </div>
                                    </div>
                                    <br>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="d-flex justify-content-center mb-2">
                                                <button type="submit" class="btn btn-primary"
                                                    data-i18n="save changes">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Delete account -->
                <div class="card mb-4" id="account-delete" hidden>
                    <form action="" method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="jumbotron">
                                        <h1 class="display-4" data-i18n="delete account">Borrar cuenta</h1>
                                        <p class="lead" data-i18n="delete account msg1">Esta acción borrará su cuenta definitivamente, ¡perderá todos
                                            sus datos y no podrá recuperarlos!</p>
                                        <hr class="my-4">
                                        <p data-i18n="delete account msg2">¿Seguro que desea continuar con el proceso?</p>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="d-flex justify-content-center mb-2">
                                                    <input type="text" name="" name="email" hidden>
                                                    <button type="submit" class="btn btn-primary"
                                                        data-i18n="delete account">Delete account</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>

    </section>

    <!--Pie de página-->
    <?php
    require_once("../footer/footer.lite.php");
    ?>

    <script>
        const links = document.querySelectorAll('.nav-link');

        for (let i = 0; i < links.length; i++) {
            links[i].addEventListener('click', function (event) {
                event.preventDefault(); // prevenir el comportamiento predeterminado del enlace
                const target = this.dataset.target; // obtener el id del card desde el atributo data-target
                const cards = document.querySelectorAll('.card');
                for (let j = 0; j < cards.length; j++) {

                    cards[j].hidden = true; // ocultar todos los cards
                }
                for (let k = 0; k < links.length; k++) {
                    links[k].classList.remove('active'); // quitar la clase active de todos los nav-link
                }
                document.getElementById(target).hidden = false; // mostrar el card correspondiente
                this.classList.add('active'); // agregar la clase active al nav-link seleccionado
            });
        }

        const languageItems = document.querySelectorAll(".language-item");

        languageItems.forEach(item => {
            item.addEventListener("click", function () {
                // Obtener la imagen y el icono del item seleccionado
                const imageUrl = this.querySelector("img").src;
                const selectedIcon = document.querySelector("#language-selected-icon");
                // Obtener el nombre del item seleccionado
                const languageName = this.querySelector("span").innerText;

                // Cambiar la imagen del botón del dropdown-toggle
                document.querySelector("#language-selected-image").src = imageUrl;
                // Cambiar el texto del idioma seleccionado
                document.querySelector("#language-selected-name").innerText = languageName;

                // Mover el icono de seleccionado al nuevo item seleccionado
                selectedIcon.parentNode.removeChild(selectedIcon);
                const icon = document.createElement("span");
                icon.id = "language-selected-icon";
                icon.innerText = "\u2714";
                const dropdownItem = this.querySelector(".dropdown-item");
                insertAfter(icon, dropdownItem.lastElementChild);

                // Obtener el data-language-id del item seleccionado
                const languageId = this.getAttribute("data-language-id");
                // Traducir
                loadTranslations(languageId);
            });
        });

        function insertAfter(newNode, existingNode) {
            existingNode.parentNode.insertBefore(newNode, existingNode.nextSibling);
        }

    </script>

</body>

</html>

<style>
    .menu-icon {
        height: 25px;
    }

    .language-selected-icon {
        height: 20px;
        color: green;
    }

    .dropdown-toggle {
        text-decoration: none;
    }

    .dropdown {
        list-style-type: none;
    }
</style>
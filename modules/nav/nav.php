<nav class="navbar fixed-top navbar-expand-md bg-body-tertiary">
    <div class="container-fluid">

        <!-- Brand container (Logo, title) -->
        <div class="brand-container">
            <img src="img/logo.png" alt="" class="logo">
            <a class="navbar-brand" href="#">
                <?= BRAND ?>
            </a>
        </div>
        <!-- Brand container (Logo, title) -->

        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler"
            aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Toggle button -->

        <!-- Collapsible navbar -->
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">

                <!-- Menu links -->
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#" data-i18n="home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-i18n="about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-i18n="contact">Contact</a>
                </li>
                <!-- Menu links -->

                <!-- Session options -->
                <?php if (!isset($_SESSION["email"])) { ?>
                    <li class="session-container nav-item">
                        <a href="modules/user/user.login.php" class="btn btn-primary" data-i18n="login">Login</a>
                        <a href="modules/user/user.register.php" class="btn btn-outline-primary"
                            data-i18n="register">Register</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="img/portrait.png" class="rounded-circle menu-icon" alt="Portrait" loading="lazy" />
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="modules/user/user.settings.php" data-i18n="settings">Settings</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="modules/user/user.logout.php" data-i18n="logout">Logout</a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <!-- Session options -->

                <!-- Language menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="modules/nav/img/flag-great-britain.png" alt="" class="menu-icon"
                            id="language-selected-image">
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li class="language-item" data-language-id="en">
                            <a class="dropdown-item" href="#">
                                <img src="modules/nav/img/flag-great-britain.png" alt="" class="menu-icon">
                                <span>English</span>
                                <span id="language-selected-icon">&#x2714;</span>
                            </a>
                        </li>
                        <li class="language-item" data-language-id="es">
                            <a class="dropdown-item" href="#">
                                <img src="modules/nav/img/flag-spain.png" alt="" class="menu-icon">
                                <span>Español</span></a>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Language menu -->

            </ul>
        </div>
        <!-- Collapsible navbar -->

    </div>
</nav>

<!-- Styles -->
<style>
    .navbar {
        text-align: center;
    }

    .brand-container {
        display: flex;
        align-items: center;
    }

    .logo {
        height: 60px;
        padding-right: 5px;
    }

    .navbar-toggler:focus {
        box-shadow: none;
    }

    .navbar-nav {
        align-items: center;
    }

    .navbar-collapse {
        flex-grow: 0;
    }

    .menu-icon {
        height: 25px;
    }

    .language-selected-icon {
        height: 20px;
        color: green;
    }
</style>
<!-- Styles -->

<script>

    // Selección de idioma
    window.onload = function () {
        const languageItems = document.querySelectorAll(".language-item");

        // Recuperar el idioma seleccionado del almacenamiento local (si existe)
        const selectedLanguageId = localStorage.getItem("selectedLanguageId");

        languageItems.forEach(item => {
            item.addEventListener("click", function () {
                // Obtener la imagen y el icono del item seleccionado
                const imageUrl = this.querySelector("img").src;
                const selectedIcon = document.querySelector("#language-selected-icon");
                // Cambiar la imagen del botón del dropdown-toggle
                document.querySelector("#language-selected-image").src = imageUrl;
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
                // Guardar en local el idioma seleccionado
                localStorage.setItem("selectedLanguageId", languageId);
            });
            // Seleccionar el elemento correspondiente al valor guardado en local
            if (selectedLanguageId && item.getAttribute("data-language-id") === selectedLanguageId) {
                item.click();
            }
        });

        function insertAfter(newNode, existingNode) {
            existingNode.parentNode.insertBefore(newNode, existingNode.nextSibling);
        }
    }



</script>
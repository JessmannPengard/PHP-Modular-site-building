<!-- Nav module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

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

                <?php
                require("plugins/session.plugin.php");

                require("plugins/language.plugin.php");
                ?>


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
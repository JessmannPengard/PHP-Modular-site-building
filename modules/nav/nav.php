<!-- Nav module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<!-- Collapse NavBar by clicking outside: start -->
<a class="close-navbar-toggler collapsed" data-bs-toggle="collapse" data-bs-target="#navbarToggler"
    aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation"></a>
<!-- Collapse NavBar by clicking outside: end -->

<!-- NavBar: start -->
<nav class="navbar fixed-top navbar-expand-md" id="nav">
    <div class="container-fluid">

        <!-- Brand container (Logo, title): start -->
        <div class="brand-container">
            <img src="img/logo.png" alt="" class="logo">
            <a class="navbar-brand" href="#">
                <?= BRAND ?>
            </a>
        </div>
        <!-- Brand container (Logo, title): end -->

        <!-- Toggle button: start -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler"
            aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Toggle button: end -->

        <!-- Collapsible navbar: start -->
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">

                <!-- Menu links: start -->
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" data-bs-toggle="collapse"
                        data-bs-target=".navbar-collapse.show" href="#" data-i18n="home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target=".navbar-collapse.show"
                        data-i18n="about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="collapse" data-bs-target=".navbar-collapse.show"
                        data-i18n="contact">Contact</a>
                </li>
                <!-- Menu links: end -->

                <?php
                // Session plugin
                require("plugins/session.plugin.php");
                // Language plugin
                require("plugins/language.plugin.php");
                ?>


            </ul>
        </div>
        <!-- Collapsible navbar: end -->

    </div>
</nav>
<!-- NavBar: end -->

<!-- Script: start -->
<script>
    // Header color transition on scroll (Comment or delete this code if you don't want this behavior)
    const nav = document.getElementById('nav');
    const navLinks = document.querySelectorAll('.nav-link');
    const navBrand = document.querySelector('.navbar-brand');
    const navToggler = document.querySelector('.navbar-toggler-icon');
    const posHeader = nav.offsetTop;
    const wP = window.scrollY;

    if (wP <= posHeader) {
        nav.classList.add("dark");
        navToggler.classList.add("navbar-dark");
        navLinks.forEach(element => {
            element.classList.remove('nav-link-light');
            element.classList.add('nav-link-dark');
        });
        navBrand.classList.remove('navbar-brand-light');
        navBrand.classList.add('navbar-brand-dark');
    }

    window.addEventListener('scroll', () => {
        const wPos = window.scrollY;

        if (wPos > posHeader) {
            nav.classList.remove("dark");
            navToggler.classList.remove("navbar-dark");
            navLinks.forEach(element => {
                element.classList.remove('nav-link-dark');
                element.classList.add('nav-link-light');
            });
            navBrand.classList.remove('navbar-brand-dark');
            navBrand.classList.add('navbar-brand-light');
        } else {
            nav.classList.add("dark");
            navToggler.classList.add("navbar-dark");
            navLinks.forEach(element => {
                element.classList.remove('nav-link-light');
                element.classList.add('nav-link-dark');
            });
            navBrand.classList.remove('navbar-brand-light');
            navBrand.classList.add('navbar-brand-dark');
        }
    });

</script>
<!-- Script: end -->

<!-- Styles: start -->
<style>
    /* This is for collapse navbar by clicking outside */
    body {
        min-height: 100vh;
        background: #fff;
        position: relative;
    }

    .close-navbar-toggler {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        z-index: 1;
        cursor: pointer;
    }

    /* ----------------------------------------------- */

    #nav {
        /* This is for collapse navbar by clicking outside */
        z-index: 2;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        /* ----------------------------------------------- */
        text-align: center;
        transition: background-color .5s ease-in-out;
        background-color: white;
    }

    .close-navbar-toggler.collapsed {
        z-index: -1;
    }

    #nav.dark {
        background-color: transparent;
        background-image: linear-gradient(to top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.5));
    }

    .navbar-brand .nav-link {
        transition: color .5s ease-in-out;
    }

    .nav-link-dark,
    .navbar-brand-dark {
        color: white;
    }

    .nav-link-light,
    .navbar-brand-light {
        color: black;
    }

    .nav-link.active {
        color: dimgrey !important;
    }

    .brand-container {
        display: flex;
        align-items: center;
    }

    .logo {
        height: 60px;
        padding-right: 5px;
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
        height: 25px;
        color: green;
    }
</style>
<!-- Styles: end -->
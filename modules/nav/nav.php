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
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <!-- Menu links -->

                <!-- Session options -->
                <?php if (!isset($_SESSION["email"])) { ?>
                    <li class="session-container nav-item">
                        <a href="modules/user/user.login.php" class="btn btn-primary">Login</a>
                        <a href="modules/user/user.register.php" class="btn btn-outline-primary">Register</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="img/portrait.png" class="rounded-circle menu-icon" alt="Portrait" loading="lazy" />
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">My profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Settings</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="modules/user/user.logout.php">Logout</a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <!-- Session options -->

                <!-- Language menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="modules/nav/img/flag-great-britain.png" alt="" class="menu-icon">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><img src="modules/nav/img/flag-great-britain.png" alt=""
                                    class="menu-icon">English
                                <svg xmlns="http://www.w3.org/2000/svg" class="language-selected"
                                    viewBox="0 0 448 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <path
                                        d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
                                </svg></a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li><a class="dropdown-item" href="#"><img src="modules/nav/img/flag-spain.png" alt=""
                                    class="menu-icon">Español</a></li>
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

    .language-selected {
        height: 20px;
        fill: green;
    }
</style>
<!-- Styles -->
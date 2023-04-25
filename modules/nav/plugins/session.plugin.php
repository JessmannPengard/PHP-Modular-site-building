<!-- Session plugin -->
<?php if (!isset($_SESSION["email"])) { ?>
    <li class="session-container nav-item">
        <a href="modules/user/user.login.php" class="btn btn-primary" data-i18n="login">Login</a>
        <a href="modules/user/user.register.php" class="btn btn-outline-primary" data-i18n="register">Register</a>
    </li>
<?php } else { ?>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
<!-- Session plugin -->
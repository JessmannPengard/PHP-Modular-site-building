<!-- Session plugin by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<!-- Session plugin: start -->
<!-- If there is no session, show login/register options -->
<?php if (!isset($_SESSION["email"])) { ?>
    <li class="session-container nav-item">
        <a href="modules/user/user.login.php" class="btn btn-primary">
            <?= $lang["login"] ?>
        </a>
        <a href="modules/user/user.register.php" class="btn btn-outline-primary">
            <?= $lang["register"] ?>
        </a>
    </li>
<?php } else { // If a session exists, show user options
        require_once("modules/database/database.php");
        require_once("modules/user/user.model.php");
        $db = new Database();
        $user = new User($db->getConnection());
        $id_user = $user->getId($_SESSION["email"]);
        $profilePicture = $user->getProfilePicture($id_user);
        // If there is a profile picture show it, else show a generic icon
        ?>
    <!-- Logged user options menu: start -->
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="<?= $profilePicture ? $profilePicture : "img/svg/user.svg" ?>" class="rounded-circle menu-icon"
                alt="Portrait" loading="lazy" />
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a class="dropdown-item" href="modules/user/user.settings.php">
                    <?= $lang["settings"] ?>
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="modules/user/user.logout.php">
                    <?= $lang["logout"] ?>
                </a>
            </li>
        </ul>
    </li>
    <!-- Logged user options menu: end -->
<?php } ?>
<!-- Session plugin: end -->
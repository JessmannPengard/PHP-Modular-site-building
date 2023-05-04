<!-- User module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<?php
// Includes
require_once("../../config/app.php");
require_once("../../modules/database/database.php");
require_once("user.model.php");
require_once("../language/language.php");

// Init error variable
$msg = "";

// on POST...
if (isset($_POST["email"])) {
    // Get user email and password
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Connect to DB
    $db = new Database();
    $user = new User($db->getConnection());

    // Call login method
    if ($user->login($email, $password)) {
        // Login success, init session
        // Start session if not started yet
        session_status() == PHP_SESSION_NONE ? session_start() : null;
        // Store email in session
        $_SESSION["email"] = $email;
        // Store language in session
        $id_user = $user->getId($email);
        $language = $user->getLanguage($id_user);
        $_SESSION["language"] = $language;
        // Close DB connection
        $db->closeConnection();
        // Redirect: index
        header("Location: ../../index.php");
        exit();
    } else {
        // Login not successful, show error message
        $msg = $lang["wrong email or password"];
    }
    // Close DB connection
    $db->closeConnection();
}

?>

<!-- Header template: start -->
<?php require("user.header.template.php"); ?>
<!-- Header template: end -->

<!-- Content: start -->
<div class="container user-form col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-8 col-11">

    <!-- Title: start -->
    <h2>
        <?= $lang["login"] ?>
    </h2>
    <!-- Title: end -->

    <!-- Login form: start -->
    <form action="" method="post" class="form">

        <!-- Fields: start -->
        <div class="form-group">
            <label for="email" class="form-label">
                <?= $lang["email"] ?>
            </label>
            <input type="email" class="form-control" name="email" maxlength=50 required autofocus>
        </div>
        <div class="form-group">
            <label for="password" class="form-label">
                <?= $lang["password"] ?>
            </label>
            <input type="password" class="form-control" name="password" maxlength=50 required>
        </div>
        <!-- Fields: end -->

        <!-- Error message container: start -->
        <div class="form-group">
            <p class="form-error">
                <?= $msg ?>
            </p>
        </div>
        <!-- Error message container: end -->
        <br>

        <!-- Submit button: start -->
        <div class="form-group form-center-container">
            <button type="submit" class="btn btn-primary">
                <?= $lang["login"] ?>
            </button>
        </div>
        <!-- Submit button: end -->
        <hr>

        <!-- Register and Recovery links: start -->
        <div class="form-group form-center-container">
            <small data-i18n="not account">
                <?= $lang["not account"] ?>
            </small>
            <small><a href="user.register.php" class="user-link">
                    <?= $lang["register here"] ?>
                </a></small>
            <br>
            <small>
                <a href="user.passwordrecovery.php" class="user-link">
                    <?= $lang["forgot password"] ?>
                </a>
            </small>
        </div>
        <!-- Register and Recovery links: end -->


    </form>
    <!-- Login form: end -->

</div>
<!-- Content: start -->

<!-- Footer template: start -->
<?php require("user.footer.template.php"); ?>
<!-- Footer template: end -->
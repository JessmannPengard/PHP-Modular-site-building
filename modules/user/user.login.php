<!-- User module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<?php
// Includes
require("../../config/app.php");
require("../../modules/database/database.php");
require("user.model.php");

// Init error variable
$msgWrong = "hidden";

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
        session_start();
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
        $msgWrong = "";
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
    <h2 data-i18n="log in">Inicia sesión</h2>
    <!-- Title: end -->

    <!-- Login form: start -->
    <form action="" method="post" class="form">

        <!-- Fields: start -->
        <div class="form-group">
            <label for="email" class="form-label" data-i18n="email">Email</label>
            <input type="text" class="form-control" name="email" maxlength=50 required autofocus>
        </div>
        <div class="form-group">
            <label for="password" class="form-label" data-i18n="password">Contraseña</label>
            <input type="password" class="form-control" name="password" maxlength=50 required>
        </div>
        <!-- Fields: end -->

        <!-- Error message container: start -->
        <div class="form-group">
            <p class="form-error" data-i18n="wrong email or password" <?= $msgWrong ?>>Email
                y/o contraseña incorrectos</p>
        </div>
        <!-- Error message container: end -->
        <br>

        <!-- Submit button: start -->
        <div class="form-group form-center-container">
            <button type="submit" class="btn btn-primary" data-i18n="login">Iniciar sesión</button>
        </div>
        <!-- Submit button: end -->
        <hr>

        <!-- Register and Recovery links: start -->
        <div class="form-group form-center-container">
            <small data-i18n="not account">¿Todavía no tienes una cuenta?</small>
            <small><a href="user.register.php" class="user-link" data-i18n="register here"> Regístrate
                    aquí</a></small>
            <br>
            <small>
                <a href="user.passwordrecovery.php" class="user-link" data-i18n="forgot password">He olvidado mi
                    contraseña</a>
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
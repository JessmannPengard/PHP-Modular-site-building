<!-- User module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<?php
// Includes
require("../../config/app.php");
require("../../modules/database/database.php");
require("user.model.php");

// Init error messagess variables
$msgEmailExists = "hidden";
$msgErrorPass = "hidden";

// if POST...
if (isset($_POST["email"])) {
    // Get email and password
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Connect to DB
    $db = new Database();
    $user = new User($db->getConnection());

    // Call User->register method
    $registro = $user->register($email, $password);
    // Success
    if ($registro["result"]) {
        // Close DB connection
        $db->closeConnection();
        // Redirect to login
        header("Location: user.login.php");
        exit();
    } else {
        // Email already registered
        $msgEmailExists = "";
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
    <h2 data-i18n="create account">Crear cuenta</h2>
    <!-- Title: end -->

    <!-- Register form: start -->
    <form action="" method="post" class="form" id="form-register">

        <!-- Fields: start -->
        <div class="form-group">
            <label for="email" class="form-label" data-i18n="email">Email</label>
            <input type="text" name="email" class="form-control" maxlength=50 required autofocus>
        </div>
        <div class="form-group">
            <label for="password" class="form-label" data-i18n="password">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control" maxlength=50 required>
        </div>
        <div class="form-group">
            <label for="r-password" class="form-label" data-i18n="repeat password">Repetir contraseña</label>
            <input type="password" name="r-password" id="r-password" class="form-control" maxlength=50 required>
        </div>
        <!-- Fields: end -->

        <!-- Error messsage container: start -->
        <div class="form-group">
            <p class="form-error" data-i18n="email already registered" <?= $msgEmailExists ?>>Este email ya está
                registrado</p>
            <p class="form-error" data-i18n="password not match" id="password-match" <?= $msgErrorPass ?>>La
                contraseña no coincide</p>
        </div>
        <br>
        <!-- Error messsage container: end -->

        <!-- Submit button: start -->
        <div class="form-group form-center-container">
            <button type="submit" class="btn btn-primary" data-i18n="register">Registrarse</button>
        </div>
        <hr>
        <!-- Submit button: end -->

        <!-- Login link: start -->
        <div class="form-group form-center-container">
            <small data-i18n="already registered">¿Ya tienes una cuenta? </small>
            <small>
                <a href="user.login.php" class="user-link" data-i18n="log in"> Inicia sesión</a>
            </small>
        </div>
        <!-- Login link: end -->

    </form>
    <!-- Register form: end -->

</div>
<!-- Content: end -->

<!-- Footer template: start -->
<?php require("user.footer.template.php"); ?>
<!-- Footer template: end -->

<!-- Script: start -->
<script>
    // Check both password fields equal
    let form = document.getElementById("form-register");
    form.onsubmit = function(e) {
        let passw = document.getElementById("password").value;
        let cpassw = document.getElementById("r-password").value;
        if (passw != cpassw) {
            e.preventDefault();
            // Error: not equal
            elementError = document.getElementById("password-match").hidden = false;
        }
    }
</script>
<!-- Script: end -->
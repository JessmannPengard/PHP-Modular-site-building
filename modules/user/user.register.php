<!-- User module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<?php
// Includes
require("../../config/app.php");
require("../../modules/database/database.php");
require("user.model.php");
require_once("../language/language.php");

// Init error message variable
$msg = "";

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
        $msg = $lang["email already registered"];
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
        <?= $lang["create account"] ?>
    </h2>
    <!-- Title: end -->

    <!-- Register form: start -->
    <form action="" method="post" class="form" id="form-register">

        <!-- Fields: start -->
        <div class="form-group">
            <label for="email" class="form-label">
                <?= $lang["email"] ?>
            </label>
            <input type="text" name="email" class="form-control" maxlength=50 required autofocus>
        </div>
        <div class="form-group">
            <label for="password" class="form-label">
                <?= $lang["password"] ?>
            </label>
            <input type="password" name="password" id="password" class="form-control" maxlength=50 required>
        </div>
        <div class="form-group">
            <label for="r-password" class="form-label">
                <?= $lang["repeat password"] ?>
            </label>
            <input type="password" name="r-password" id="r-password" class="form-control" maxlength=50 required>
        </div>
        <!-- Fields: end -->

        <!-- Error message container: start -->
        <div class="form-group">
            <p class="form-error" id="error-msg">
                <?= $msg ?>
            </p>
        </div>
        <br>
        <!-- Error message container: end -->

        <!-- Submit button: start -->
        <div class="form-group form-center-container">
            <button type="submit" class="btn btn-primary">
                <?= $lang["register"] ?>
            </button>
        </div>
        <hr>
        <!-- Submit button: end -->

        <!-- Login link: start -->
        <div class="form-group form-center-container">
            <small>
                <?= $lang["already registered"] ?>
            </small>
            <small>
                <a href="user.login.php" class="user-link">
                    <?= $lang["log in"] ?>
                </a>
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
    // Check for both password fields equal
    const form = document.getElementById("form-register");
    const elementError = document.getElementById("error-msg");
    form.onsubmit = function (e) {
        let passw = document.getElementById("password").value;
        let cpassw = document.getElementById("r-password").value;
        if (passw != cpassw) {
            e.preventDefault();
            elementError.innerText = lang["password not match"];
        }
    }
</script>
<!-- Script: end -->
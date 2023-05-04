<!-- User module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<?php
// Includes
require("../../config/app.php");
require("../../modules/database/database.php");
require("user.model.php");
require_once("../language/language.php");

// Init error message variable
$msg = "";

// Check for POST
if (isset($_GET['email']) && isset($_GET["token"]) && isset($_POST["password"])) {
    // Get email and new password from user, and security token
    $email = $_GET['email'];
    $token = $_GET['token'];
    $password = $_POST['password'];

    // Connect to DB
    $db = new Database();
    $user = new User($db->getConnection());

    // Verify email-token
    if ($user->checkToken($email, $token)) {

        // Set new password
        $result = $user->setPassword($email, $password);

        if ($result["result"] == false) {
            // Email not registered
            $msg = $lang["email not registered"];
        } else {
            // Success: delete stored tokens from user
            $user->deleteToken($email);
            // Redirect to login
            header("Location: user.login.php");
        }
    } else {
        // Invalid token
        $msg = $lang["recovery link not valid"];
    }
} else {
    // Invalid data
    $msg = $lang["recovery link not valid"];
}
?>

<!-- Header template: start -->
<?php require("user.header.template.php"); ?>
<!-- Header template: end -->

<!-- Content: start -->
<div class="container user-form col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-8 col-11">

    <!-- Title: start -->
    <h2>
        <?= $lang["reset password"] ?>
    </h2>
    <!-- Title: end -->

    <!-- Pasword reset form: start -->
    <form action="" method="post" class="form" id="form-reset">

        <!-- Fields: start -->
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
            <div class="form-error">
                <p id="error-msg">
                    <?= $msg ?>
                </p>
                <small>
                    <a href='user.passwordrecovery.php' class='user-link'>
                        <?= $lang["password recovery"] ?>
                    </a>
                </small>
            </div>
        </div>
        <br>
        <!-- Error message container: end -->

        <!-- Submit button: start -->
        <div class="form-group form-center-container">
            <button type="submit" class="btn btn-primary">
                <?= $lang["reset password"] ?>
            </button>
        </div>
        <hr>
        <!-- Submit button: end -->

    </form>
    <!-- Pasword reset form: end -->

</div>
<!-- Content: start -->

<!-- Footer template: start -->
<?php require("user.footer.template.php"); ?>
<!-- Footer template: end -->

<!-- Script: start -->
<script>
    // Check for both password fields equal
    const form = document.getElementById("form-reset");
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
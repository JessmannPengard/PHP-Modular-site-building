<!-- User module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<?php
// Includes
require_once("../../config/app.php");
require_once("../database/database.php");
require_once("user.model.php");
require_once("../mail/Mail.php");
require_once("../language/language.php");

// Init error message variable
$msg = "";

// Check if email was sent
if (isset($_POST['email'])) {
    // Get posted user email
    $email = $_POST['email'];

    // Check for registered email
    $db = new Database();
    $user = new User($db->getConnection());

    if ($user->existEmail($email)) {
        // If so...
        // Generate recovery token
        $token = bin2hex(random_bytes((20)));
        // Calculate expiry date (1 hour from creation)
        $expiry_date = date('Y-m-d H:i:s', strtotime('+1 hour'));
        // Store token in DB
        $result = $user->setToken($email, $token, $expiry_date);

        // Instantiate Mail class
        $mail = new Mail();

        // Mail details
        $fromEmail = MAIL_MYEMAIL;
        $fromName = BRAND;
        $toEmail = $email;
        $subject = $lang['password recovery'];
        $url = __DIR__ . '\user.passwordreset.php?email=' . $email . '&token=' . $token;
        $body = "
                <html>
                <head>
                    <style>
                        .button {
                            background-color: #4CAF50;
                            border: none;
                            border-radius: 5px;
                            color: white;
                            padding: 15px 32px;
                            text-align: center;
                            text-decoration: none;
                            display: inline-block;
                            font-size: 16px;
                            margin: 4px 2px;
                            cursor: pointer;
                        }
                    </style>
                </head>
                <body>" .
            $lang['recovery mail 1'] .
            "<a href='" . $url . "' class='button'>" . $lang["reset password"] . "</a>" .
            $lang['recovery mail 2'] .
            "<p>" . $url . "</p>" .
            $lang['recovery mail 3'] .
            "<p>" . BRAND . "</p>
                </body>
                </html>
                ";

        // Send mail and check for success
        if ($mail->sendMail($fromEmail, $fromName, $toEmail, $subject, $body)) {
            $msg = $lang["recovery mail sent"];
        } else {
            $msg = $lang["mail sending error"];
        }
    } else {
        $msg = $lang["email not registered"];
    }
}

?>

<!-- Header template: start -->
<?php require("user.header.template.php"); ?>
<!-- Header template: end -->

<!-- Content: start -->
<div class="container user-form col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-8 col-11">

    <!-- Title: start -->
    <h2>
        <?= $lang["password recovery"] ?>
    </h2>
    <!-- Title: end -->

    <!-- Password recovery form: start -->
    <form action="" method="post" class="form">

        <!-- Fields: start -->
        <div class="form-group">
            <label for="email" class="form-label">
                <?= $lang["email"] ?>
            </label>
            <input type="text" class="form-control" name="email" maxlength=50 required autofocus>
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
                <?= $lang["send email"] ?>
            </button>
        </div>
        <!-- Submit button: end -->
        <hr>

        <!-- Init session link: start -->
        <div class="form-group form-center-container">
            <small>
                <?= $lang["or"] ?>
            </small><small><a href="user.login.php" class="user-link">
                    <?= $lang["sign in"] ?>
                </a></small>
        </div>
        <!-- Init session link: end -->


    </form>
    <!-- Password recovery form: end -->

</div>
<!-- Content: end -->

<!-- Footer template: start -->
<?php require("user.footer.template.php"); ?>
<!-- Footer template: end -->
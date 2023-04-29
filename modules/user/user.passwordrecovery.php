<!-- User module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<?php
// Includes
require("../../config/app.php");
require("../database/database.php");
require("user.model.php");
require("../mail/Mail.php");

// Error messages
$msgMailSent = "hidden";
$msgMailingError = "hidden";
$msgMailNotReg = "hidden";
$msgMailerError = "hidden";

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
        $subject = 'Recuperación de contraseña';
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
                <body>
                    <p>Hola,</p>
                    <p>Hemos recibido una solicitud para restablecer tu contraseña. Si no has solicitado este cambio, por favor ignora este mensaje.</p>
                    <p>Para restablecer tu contraseña, por favor haz clic en el siguiente botón:</p>
                    <a href='" . $url . "' class='button'>Restablecer contraseña</a>
                    <p>Si el botón no funciona, también puedes copiar y pegar la siguiente URL en tu navegador:</p>
                    <p>" . $url . "</p>
                    <p>Saludos cordiales,</p>
                    <p>El equipo de " . BRAND . "</p>
                </body>
                </html>
                ";

        // Send mail and check for success
        if ($mail->sendMail($fromEmail, $fromName, $toEmail, $subject, $body)) {
            $msgMailSent = '';
        } else {
            $msgMailingError = '';
        }
    } else {
        $msgMailNotReg = "";
    }
}

?>

<!-- Header template: start -->
<?php require("user.header.template.php"); ?>
<!-- Header template: end -->

<!-- Content: start -->
<div class="container user-form col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-8 col-11">

    <!-- Title: start -->
    <h2 data-i18n="password recovery">Password recovery</h2>
    <!-- Title: end -->

    <!-- Password recovery form: start -->
    <form action="" method="post" class="form">

        <!-- Fields: start -->
        <div class="form-group">
            <label for="email" class="form-label" data-i18n="email">Email</label>
            <input type="text" class="form-control" name="email" maxlength=50 required autofocus>
        </div>
        <!-- Fields: end -->

        <!-- Error message container: start -->
        <div class="form-group">
            <p class="form-error" data-i18n="recovery mail sent" <?= $msgMailSent ?>>Password recovery mail was sent.</p>
            <p class="form-error" data-i18n="mail sending error" <?= $msgMailingError ?>>An error ocurred while sending
                password recovery mail.</p>
            <p class="form-error" data-i18n="email not registered" <?= $msgMailNotReg ?>>Email not registered</p>
            <p class="form-error" data-i18n="mailer error" <?= $msgMailerError ?>>Message could not be sent. Mailer
                Error!</p>
        </div>
        <!-- Error message container: end -->
        <br>

        <!-- Submit button: start -->
        <div class="form-group form-center-container">
            <button type="submit" class="btn btn-primary" data-i18n="send email">Send email</button>
        </div>
        <!-- Submit button: end -->
        <hr>

        <!-- Init session link: start -->
        <div class="form-group form-center-container">
            <small data-i18n="or">o</small><small><a href="user.login.php" class="user-link" data-i18n="sign in">sign in</a></small>
        </div>
        <!-- Init session link: end -->


    </form>
    <!-- Password recovery form: end -->

</div>
<!-- Content: end -->

<!-- Footer template: start -->
<?php require("user.footer.template.php"); ?>
<!-- Footer template: end -->
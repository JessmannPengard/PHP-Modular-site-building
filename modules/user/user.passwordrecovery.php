<!-- User module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<?php
// Includes
require("../../config/app.php");
require("../database/database.php");
require("user.model.php");

require("../phpmailer/src/Exception.php");
require("../phpmailer/src/PHPMailer.php");
require("../phpmailer/src/SMTP.php");
require("../phpmailer/src/mail.config.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

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

        // new PHPMailer
        $mail = new PHPMailer();

        try {
            // Configure mail server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF; //Enable verbose debug output
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP(); //Send using SMTP
            $mail->Host = MAIL_HOST; //Set the SMTP server to send through
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->Username = MAIL_USERNAME; //SMTP username
            $mail->Password = MAIL_PASSWORD; //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = MAIL_PORT;

            // Configure email details
            $mail->setFrom(MAIL_MYEMAIL, BRAND);
            $mail->addAddress($email);
            $mail->Subject = 'Recuperación de contraseña';
            $url = __DIR__ . '\user.passwordreset.php?email=' . $email . '&token=' . $token;
            $mail->Body = "
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

            // Send email and check for success
            if ($mail->send()) {
                $msgMailSent = '';
            } else {
                $msgMailingError = '';
            }
        } catch (Exception $e) {
            $msgMailerError = "";
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
    <h2 data-i18n="password recovery">Recuperación de contraseña</h2>
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
            <p class="form-error" data-i18n="recovery mail sent" <?= $msgMailSent ?>>Se ha enviado el email de
                recuperación de contraseña.</p>
            <p class="form-error" data-i18n="mail sending error" <?= $msgMailingError ?>>Ha ocurrido un error al
                enviar el email de recuperación de contraseña.</p>
            <p class="form-error" data-i18n="email not registered" <?= $msgMailNotReg ?>>Email no registrado</p>
            <p class="form-error" data-i18n="mailer error" <?= $msgMailerError ?>>El mensaje no se ha podido enviar.
                ¡Error de Mailer!</p>
        </div>
        <!-- Error message container: end -->
        <br>

        <!-- Submit button: start -->
        <div class="form-group form-center-container">
            <button type="submit" class="btn btn-primary" data-i18n="send email">Enviar email</button>
        </div>
        <!-- Submit button: end -->
        <hr>

        <!-- Init session link: start -->
        <div class="form-group form-center-container">
            <small data-i18n="or">o</small><small><a href="user.login.php" class="user-link" data-i18n="sign in">Inicia
                    sesión</a></small>
        </div>
        <!-- Init session link: end -->


    </form>
    <!-- Password recovery form: end -->

</div>
<!-- Content: end -->

<!-- Footer template: start -->
<?php require("user.footer.template.php"); ?>
<!-- Footer template: end -->
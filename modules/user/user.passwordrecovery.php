<!-- User module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<?php
// Importamos los módulos necesarios
require("../../config/app.php");
require("../database/database.php");
require("user.model.php");

require("../phpmailer/src/Exception.php");
require("../phpmailer/src/PHPMailer.php");
require("../phpmailer/src/SMTP.php");
require("../phpmailer/src/mail.config.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// Inicializamos la variable que usaremos para mostrar mensajes en caso de algún error
$msgMailSent = "hidden";
$msgMailingError = "hidden";
$msgMailNotReg = "hidden";
$msgMailerError = "hidden";

// Verificar si se ha enviado el correo electrónico
if (isset($_POST['email'])) {
    // Obtener el correo electrónico del usuario
    $email = $_POST['email'];

    // Comprobamos que exista el usuario con ese email
    $db = new Database();
    $user = new User($db->getConnection());

    if ($user->existEmail($email)) {

        // Generamos el token de acceso aleatorio
        $token = bin2hex(random_bytes((20)));
        // Calculamos la fecha de caducidad del token (1 hora desde la creación)
        $expiry_date = date('Y-m-d H:i:s', strtotime('+1 hour'));
        // Guardamos el token en la base de datos
        $result = $user->setToken($email, $token, $expiry_date);

        // Crear un objeto PHPMailer
        $mail = new PHPMailer();

        try {
            // Configurar los ajustes del servidor de correo
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

            // Configurar los detalles del correo electrónico
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

            // Enviar el correo electrónico y comprobar si se ha enviado correctamente
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

<?php
require("user.header.template.php");
?>

<!-- Contenido de la página -->
<div class="container user-form col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-8 col-11">
    <!-- Título del formulario -->
    <h2 data-i18n="password recovery">Recuperación de contraseña</h2>
    <!-- Formulario de recuperación de contraseña -->
    <form action="" method="post" class="form">
        <div class="form-group">
            <label for="email" class="form-label" data-i18n="email">Email</label>
            <input type="text" class="form-control" name="email" maxlength=50 required autofocus>
        </div>
        <!-- Mostramos el mensaje si lo hubiera -->
        <div class="form-group">
            <p class="form-error" data-i18n="recovery mail sent" <?= $msgMailSent ?>>Se ha enviado el email de
                recuperación de contraseña.</p>
            <p class="form-error" data-i18n="mail sending error" <?= $msgMailingError ?>>Ha ocurrido un error al
                enviar el email de recuperación de contraseña.</p>
            <p class="form-error" data-i18n="email not registered" <?= $msgMailNotReg ?>>Email no registrado</p>
            <p class="form-error" data-i18n="mailer error" <?= $msgMailerError ?>>El mensaje no se ha podido enviar.
                ¡Error de Mailer!</p>
        </div>
        <br>
        <div class="form-group form-center-container">
            <button type="submit" class="btn btn-primary" data-i18n="send email">Enviar email</button>
        </div>
        <hr>
        <!-- Enlace a la página de inicio de sesión -->
        <div class="form-group form-center-container">
            <small data-i18n="or">o</small><small><a href="user.login.php" class="user-link" data-i18n="sign in">Inicia
                    sesión</a></small>
        </div>
    </form>
</div>

<?php
require("user.footer.template.php");
?>
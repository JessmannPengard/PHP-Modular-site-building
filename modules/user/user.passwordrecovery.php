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

// Inicializamos la variable que usaremos para mostrar mensajes
$msg = "";

// Verificar si se ha enviado el correo electrónico
if (isset($_POST['email'])) {
    // Obtener el correo electrónico del usuario
    $email = $_POST['email'];

    // Comprobamos que exista el usuario con ese email
    $db = new Database();
    $usuario = new User($db->getConnection());

    if ($usuario->existEmail($email)) {

        // Generamos el token de acceso aleatorio
        $token = bin2hex(random_bytes((20)));
        // Calculamos la fecha de caducidad del token (1 hora desde la creación)
        $fecha_caducidad = date('Y-m-d H:i:s', strtotime('+1 hour'));
        // Guardamos el token en la base de datos
        $result = $usuario->setToken($email, $token, $fecha_caducidad);

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
            $mail->Port = 465;

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
                $msg = 'Se ha enviado un correo electrónico de recuperación de contraseña a ' . $email;
            } else {
                $msg = 'Ha ocurrido un error al enviar el correo electrónico de recuperación de contraseña.';
            }
        } catch (Exception $e) {
            $response["succeed"] = false;
            $response["msg"] = "Message could not be sent. Mailer Error:"; //{$mail->ErrorInfo}";
        }
    } else {
        $msg = "El email no está registrado";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="../../vendor/bootstrap/css/bootstrap.css">
    <!--Estilos-->
    <link rel="stylesheet" href="user.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../../favicon.ico">
    <!-- Título de la página -->
    <title>
        <?= BRAND ?> - Password recovery
    </title>
</head>

<body>
    <!-- Encabezado de página -->
    <?php
    require_once("../nav/nav.lite.php");
    ?>

    <!-- Contenido de la página -->
    <div class="container user-form col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-8 col-11">
        <!-- Título del formulario -->
        <h2>Recuperación de contraseña</h2>
        <!-- Formulario de recuperación de contraseña -->
        <form action="" method="post" class="form">
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" placeholder="Introduce tu email" maxlength=50
                    required autofocus>
            </div>
            <!-- Mostramos el mensaje si lo hubiera -->
            <div class="form-group">
                <p class="form-error">
                    <?php echo $msg; ?>
                </p>
            </div>
            <div class="form-group form-center-container">
                <button type="submit" class="btn btn-primary">Enviar email</button>
            </div>
            <hr>
            <!-- Enlace a la página de inicio de sesión -->
            <div class="form-group form-center-container">
                <small>o <a href="user.login.php" class="user-link"> Inicia sesión</a></small>
            </div>
        </form>
    </div>

    <!-- Pie de página -->
    <?php
    require_once("../footer/footer.lite.php");
    ?>

</body>

</html>
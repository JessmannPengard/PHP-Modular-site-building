<?php
// Importamos los módulos necesarios
require("../../config/app.php");
require("../../modules/database/database.php");
require("user.model.php");

// Inicializamos la variable que usaremos para mostrar mensajes en caso de algún error
$msg = "empty";

// Verificar si se ha enviado el formulario
if (isset($_GET['email']) && isset($_GET["token"]) && isset($_POST["password"])) {
    // Obtener el correo electrónico y la nueva contraseña del usuario
    $email = $_GET['email'];
    $token = $_GET['token'];
    $password = $_POST['password'];

    // Conectarse a la base de datos y verificar si el correo electrónico y el token son válidos
    $db = new Database();
    $user = new User($db->getConnection());

    // Verificamos que el token sea válido
    if ($user->checkToken($email, $token)) {

        // Cambiamos la contraseña
        $result = $user->setPassword($email, $password);

        if ($result["result"] == false) {
            $msg = $result["msg"];
        } else {
            // Borramos los tokens de recuperación de contraseña de este usuario
            $user->deleteToken($email);
            // Y redirigimos al login
            header("Location: user.login.php");
        }
    } else {
        $msg = "recovery link not valid";
    }

}

// Mostrar el formulario de recuperación de contraseña
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="../../vendor/bootstrap/css/bootstrap.css">
    <!-- Script de idiomas -->
    <script src="../../modules/translations/translations.js"></script>
    <!--Estilos-->
    <link rel="stylesheet" href="user.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../../favicon.ico">
    <!-- Título de la página -->
    <title>
        <?= BRAND ?>
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
        <h2 data-i18n="reset password">Restablecer contraseña</h2>
        <!-- Formulario de inicio de sesión -->
        <form action="" method="post" class="form" id="form-reset">
            <div class="form-group">
                <label for="password" class="form-label" data-i18n="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" maxlength=50 required>
            </div>
            <div class="form-group">
                <label for="r-password" class="form-label" data-i18n="repeat password">Repetir password</label>
                <input type="password" name="r-password" id="r-password" class="form-control" maxlength=50 required>
            </div>
            <!-- Mostramos el mensaje de error, si lo hubiera -->
            <div class="form-group">
                <p class="form-error" id="error" data-i18n="<?= $msg ?>"></p>
            </div>
            <div class="form-group form-center-container">
                <button type="submit" class="btn btn-primary" data-i18n="reset password">Restablecer contraseña</button>
            </div>
            <hr>
        </form>
    </div>

    <!-- Pie de página -->
    <?php
    require_once("../footer/footer.lite.php");
    ?>

    <script>
        // Comprobamos que el campo Repetir password coincida con el campo Password
        let form = document.getElementById("form-reset");
        form.onsubmit = function (e) {
            let passw = document.getElementById("password").value;
            let cpassw = document.getElementById("r-password").value;
            if (passw != cpassw) {
                e.preventDefault();
                elementError = document.getElementById("error");
                const key = "password not match";
                const translation = translations[selectedLanguageId][key];
                if (translation) {
                    elementError.textContent = translation;
                }
            }
        }
    </script>

</body>

</html>
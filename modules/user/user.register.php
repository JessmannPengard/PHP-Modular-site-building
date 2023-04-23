<?php
// Importamos los módulos necesarios
require_once("../../config/app.php");
require_once("../../modules/database/database.php");
require_once("user.model.php");

// Inicializamos las variables que usaremos para mostrar mensajes en caso de algún error
$msgEmailExists = "hidden";
$msgErrorPass = "hidden";

// Si nos están enviando el formulario...
if (isset($_POST["email"])) {
    // Obtenemos los datos para el registro
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Nos conectamos a la base de datos
    $db = new Database();
    $user = new User($db->getConnection());

    // Y llamamos al método para registrar un nuevo usuario
    $registro = $user->register($email, $password);
    // Si el registro es exitoso
    if ($registro["result"]) {
        // Cerramos la conexión
        $db->closeConnection();
        // Redirigimos a la página de login para que el usuario pueda iniciar sesión
        header("Location: user.login.php");
        exit();
    } else {
        // El email ya estaba registrado mostraremos el mensaje de error
        $msgEmailExists = "";
    }
    // Cerramos la conexión
    $db->closeConnection();
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
        <h2 data-i18n="create account">Crear cuenta</h2>
        <!-- Formulario de registro -->
        <form action="" method="post" class="form" id="form-register">
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
            <!-- Mostramos el mensaje de error, si lo hubiera -->
            <div class="form-group">
                <p class="form-error" data-i18n="email already registered" <?= $msgEmailExists ?>>Este email ya está
                    registrado</p>
                <p class="form-error" data-i18n="password not match" id="password-match" <?= $msgErrorPass ?>>La
                    contraseña no coincide</p>
            </div>
            <br>
            <div class="form-group form-center-container">
                <button type="submit" class="btn btn-primary" data-i18n="register">Registrarse</button>
            </div>
            <hr>
            <!-- Enlace a la página de inicio de sesión -->
            <div class="form-group form-center-container">
                <small data-i18n="already registered">¿Ya tienes una cuenta? </small>
                <small>
                    <a href="user.login.php" class="user-link" data-i18n="log in"> Inicia sesión</a>
                </small>
            </div>
        </form>
    </div>

    <!--Pie de página-->
    <?php
    require_once("../footer/footer.lite.php");
    ?>

    <script>
        // Comprobamos que el campo Repetir password coincida con el campo Password
        let form = document.getElementById("form-register");
        form.onsubmit = function (e) {
            let passw = document.getElementById("password").value;
            let cpassw = document.getElementById("r-password").value;
            if (passw != cpassw) {
                e.preventDefault();
                // Mostramos el mensaje de error
                elementError = document.getElementById("password-match").hidden = false;
            }
        }
    </script>

</body>

</html>
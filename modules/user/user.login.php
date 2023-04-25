<?php
// Importamos los módulos necesarios
require_once("../../config/app.php");
require_once("../../modules/database/database.php");
require_once("user.model.php");

// Inicializamos las variables que usaremos para mostrar mensajes en caso de algún error
$msgWrong = "hidden";

// Si nos están enviando el formulario...
if (isset($_POST["email"])) {
    // Obtenemos el nombre de usuario y contraseña
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Nos conectamos a la base de datos
    $db = new Database();
    $user = new User($db->getConnection());

    // Y llamamos al método login para iniciar sesión
    if ($user->login($email, $password)) {
        // Login correcto, iniciamos sesión
        session_start();
        // Guardamos las variables de sesión
        $_SESSION["email"] = $email;
        // Idioma
        $id_user = $user->getId($email);
        $language = $user->getLanguage($id_user);
        $_SESSION["language"] = $language;
        // Cerramos la conexión a la base de datos
        $db->closeConnection();
        // Redirigimos a la página de inicio
        header("Location: ../../index.php");
        exit();
    } else {
        // Login incorrecto, mostraremos el mensaje de error
        $msgWrong = "";
    }
    // Cerramos la conexión a la base de datos
    $db->closeConnection();
}

?>

<?php
require("user.header.template.php");
?>

<!-- Contenido de la página -->
<div class="container user-form col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-8 col-11">
    <!-- Título del formulario -->
    <h2 data-i18n="log in">Inicia sesión</h2>
    <!-- Formulario de inicio de sesión -->
    <form action="" method="post" class="form">
        <div class="form-group">
            <label for="email" class="form-label" data-i18n="email">Email</label>
            <input type="text" class="form-control" name="email" maxlength=50 required autofocus>
        </div>
        <div class="form-group">
            <label for="password" class="form-label" data-i18n="password">Contraseña</label>
            <input type="password" class="form-control" name="password" maxlength=50 required>
        </div>
        <!-- Mostramos el mensaje de error, si lo hubiera -->
        <div class="form-group">
            <p class="form-error" data-i18n="wrong email or password" <?= $msgWrong ?>>Email
                y/o contraseña incorrectos</p>
        </div>
        <br>
        <div class="form-group form-center-container">
            <button type="submit" class="btn btn-primary" data-i18n="login">Iniciar sesión</button>
        </div>
        <hr>
        <!-- Enlace a la página de registro -->
        <div class="form-group form-center-container">
            <small data-i18n="not account">¿Todavía no tienes una cuenta?</small>
            <small><a href="user.register.php" class="user-link" data-i18n="register here"> Regístrate
                    aquí</a></small>
            <br>
            <small>
                <a href="user.passwordrecovery.php" class="user-link" data-i18n="forgot password">He olvidado mi
                    contraseña</a>
            </small>
        </div>
    </form>
</div>

<?php
require("user.footer.template.php");
?>
<?php
// Importamos los módulos necesarios
require_once("../../config/app.php");
require_once("../../modules/database/database.php");
require_once("user.model.php");

// Inicializamos la variable que usaremos para mostrar mensajes en caso de algún error
$msg = "";

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
        // Guardamos la variable de sesión
        $_SESSION["email"] = $email;
        // Cerramos la conexión a la base de datos
        $db->closeConnection();
        // Redirigimos a la página de inicio
        header("Location: ../../index.php");
        exit();
    } else {
        // Login incorrecto, guardamos el mensaje de error a mostrar más abajo
        $msg = "Email y/o contraseña incorrectos.";
    }
    // Cerramos la conexión a la base de datos
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
    <!--Estilos-->
    <link rel="stylesheet" href="user.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../../favicon.ico">
    <!-- Título de la página -->
    <title>
        <?= BRAND ?> - Login
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
        <h2>Inicia sesión</h2>
        <!-- Formulario de inicio de sesión -->
        <form action="" method="post" class="form">
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" placeholder="Introduce tu email" maxlength=50
                    required autofocus>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Introduce tu password"
                    maxlength=50 required>
            </div>
            <!-- Mostramos el mensaje de error, si lo hubiera -->
            <div class="form-group">
                <p class="form-error">
                    <?php echo $msg; ?>
                </p>
            </div>
            <div class="form-group form-center-container">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            <hr>
            <!-- Enlace a la página de registro -->
            <div class="form-group form-center-container">
                <small>¿Aún no tienes una cuenta?<a href="user.register.php" class="user-link"> Regístrate
                        aquí</a></small>
                <small><a href="user.passwordrecovery.php" class="user-link">He olvidado mi contraseña</a></small>
            </div>
        </form>
    </div>

    <!-- Pie de página -->
    <?php
    require_once("../footer/footer.lite.php");
    ?>

</body>

</html>
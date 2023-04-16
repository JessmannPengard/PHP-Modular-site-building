<?php
// Importamos los módulos necesarios
require_once("../../config/app.php");
require_once("../../modules/database/database.php");
require_once("user.model.php");

// Inicializamos la variable que usaremos para mostrar mensajes en caso de algún error
$msg = "";

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
        // Registro no realizado, guardamos el mensaje de error a mostrar más abajo
        $msg = $registro["msg"];
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
    <!--Estilos-->
    <link rel="stylesheet" href="user.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../../favicon.ico">
    <!-- Título de la página -->
    <title>
        <?= BRAND ?> - Registro
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
        <h2>Crear cuenta</h2>
        <!-- Formulario de registro -->
        <form action="" method="post" class="form" id="form-register">
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" class="form-control" maxlength=50 required
                    placeholder="Introduce tu email" autofocus>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" maxlength=50 required
                    placeholder="Introduce tu password">
            </div>
            <div class="form-group">
                <label for="r-password" class="form-label">Repetir password</label>
                <input type="password" name="r-password" id="r-password" class="form-control" maxlength=50 required
                    placeholder="Repite tu password">
            </div>
            <!-- Mostramos el mensaje de error, si lo hubiera -->
            <div class="form-group">
                <p class="form-error" id="error">
                    <?php echo $msg; ?>
                </p>
            </div>
            <div class="form-group form-center-container">
                <button type="submit" class="btn btn-primary">Registrarse</button>
            </div>
            <hr>
            <!-- Enlace a la página de inicio de sesión -->
            <div class="form-group form-center-container">
                <small>¿Ya tienes una cuenta?<a href="user.login.php" class="user-link"> Inicia sesión</a></small>
            </div>
        </form>
    </div>

    <!--Pie de página-->
    <?php
    require_once("../footer/footer.lite.php");
    ?>

    <script>
        // Comprobamos que el cambo Repetir password coincida con el campo Password
        window.onload = function () {
            let form = document.getElementById("form-register");
            form.onsubmit = function (e) {
                let passw = document.getElementById("password").value;
                let cpassw = document.getElementById("r-password").value;
                if (passw != cpassw) {
                    e.preventDefault();
                    document.getElementById("error").innerHTML = "La contraseña no coincide.";
                }
            }
        }
    </script>

</body>

</html>
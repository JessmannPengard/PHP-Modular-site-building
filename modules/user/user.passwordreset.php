<?php
// Importamos los módulos necesarios
require_once("../../config/app.php");
require_once("../../modules/database/database.php");
require_once("user.model.php");

// Inicializamos la variable que usaremos para mostrar mensajes en caso de algún error
$msg = "";

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener el correo electrónico y la nueva contraseña del usuario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validar que el correo electrónico y la contraseña no estén vacíos
    if (empty($email) || empty($password)) {
        $msg = 'Por favor, establezca su nueva contraseña.';
    } else {
        // Conectarse a la base de datos y verificar si el correo electrónico es válido
        $conexion = new mysqli('localhost', 'usuario', 'contraseña', 'basedatos');
        $consulta = $conexion->prepare('SELECT id FROM usuarios WHERE email = ?');
        $consulta->bind_param('s', $email);
        $consulta->execute();
        $resultado = $consulta->get_result();

        if ($resultado->num_rows == 0) {
            $mensaje = 'El correo electrónico ' . $email . ' no está registrado en nuestro sistema.';
        } else {
            // Actualizar la contraseña del usuario
            $id = $resultado->fetch_assoc()['id'];
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $consulta = $conexion->prepare('UPDATE usuarios SET password = ? WHERE id = ?');
            $consulta->bind_param('si', $password_hash, $id);
            $consulta->execute();

            // Redirigir al usuario a la página de inicio de sesión con un mensaje de éxito
            header('Location: user.login.php');
            exit;
        }
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
    <!--Estilos-->
    <link rel="stylesheet" href="user.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../../favicon.ico">
    <!-- Título de la página -->
    <title>
        <?= BRAND ?> - Password reset
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
        <h2>Restablecer contraseña</h2>
        <!-- Formulario de inicio de sesión -->
        <form action="" method="post" class="form">
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Introduce tu nueva contraseña"
                    maxlength=50 required>
            </div>
            <div class="form-group">
                <label for="r-password" class="form-label">Repetir password</label>
                <input type="password" name="r-password" id="r-password" class="form-control" maxlength=50 required
                    placeholder="Repite tu nueva contraseña">
            </div>
            <!-- Mostramos el mensaje de error, si lo hubiera -->
            <div class="form-group">
                <p class="form-error">
                    <?php echo $msg; ?>
                </p>
            </div>
            <div class="form-group form-center-container">
                <button type="submit" class="btn btn-primary">Restablecer contraseña</button>
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
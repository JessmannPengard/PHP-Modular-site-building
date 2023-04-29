<?php

// Auth session
require("../user/user.authsession.php");

// Requires
require("../../config/app.php");
require("../database/database.php");
require("gallery.model.php");
require("gallery.config.php");
require("../user/user.model.php");

// DB connection
$db = new Database();

// Path for uploaded pictures
$directorio_subida = GALLERY_UPLOAD_PATH;

// Inicializamos la variable que guardará el mensaje en caso de posibles errores
$msg = "";

// Si nos han enviado una imagen:
if (isset($_POST["file"])) {
    // Verificamos si se subió un archivo y si no hay errores
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Verificamos el tipo de archivo (aquí establecemos los tipos de archivos permitidos)
        $tipos_permitidos = array('image/jpeg', 'image/png');
        if (in_array($_FILES['image']['type'], $tipos_permitidos)) {
            // Verificamos el tamaño del archivo, aquí establecemos el tamaño máximo de archivo permitido
            $tamano_maximo = 5 * 1024 * 1024; // 5MB
            if ($_FILES['image']['size'] <= $tamano_maximo) {
                // Renombramos el archivo para evitar sobrescribir archivos existentes mediante la función uniqid
                $nombre_archivo = uniqid('imagen_', true) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                // Movemos el archivo a la carpeta de destino que hemos designado ($directorio_subida) con el nuevo nombre de archivo
                if (move_uploaded_file($_FILES['image']['tmp_name'], '../../'.$directorio_subida . $nombre_archivo)) {
                    // El archivo se subió correctamente
                    // Obtenemos los id's de usuario e imagen
                    $usuario = new User($db->getConnection());
                    $imagen = new Gallery($db->getConnection());
                    // Y los guardamos en la base de datos junto con la ruta del archivo que se acaba de subir
                    $imagen->upload($usuario->getId($_SESSION["username"]), $directorio_subida . $nombre_archivo);
                    $msg = "Imagen subida correctamente";
                    // Recargamos la página
                    header("Location: ../../index.php");
                } else {
                    // Error al mover el archivo
                    $msg = "Hubo un error al mover el archivo";
                }
            } else {
                // Archivo demasiado grande
                $msg = "El archivo es demasiado grande (tamaño máximo permitido: " . $tamano_maximo / 1024 / 1024 . "MB)";
            }
        } else {
            // Tipo de archivo no permitido
            $msg = "El tipo de archivo no está permitido";
        }
    } else {
        // Error al subir el archivo
        $msg = "Hubo un error al subir el archivo";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title -->
    <title>
        <?= BRAND ?>
    </title>

    <!-- Bootstrap -->
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="../../vendor/bootstrap/css/bootstrap.css">
</head>

<body>

    <!-- Nav-lite: start -->
    <?php require("../nav/nav.lite.php"); ?>
    <!-- Nav-lite: end -->

    <!-- Subir imagen -->
    <div class="container-fluid upload-image">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <!-- Título del formulario -->
                <h3>Subir imagen</h3>
                <hr>
                <div>
                    <p>PNG o JPEG, tamaño máximo permitido: 5MB</p>
                </div>
                <div class="form-group d-none" id="previewImg">
                    <img id="preview" src="#" alt="Previsualización de la imagen">
                </div>
                <form id="formulario" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="file" class="form-control-file" id="image" name="image"
                            accept="image/png, image/jpeg">
                    </div>
                    <!-- Mensaje de error si lo hubiese -->
                    <div class="mb-3">
                        <p class='error-text'>
                            <?php echo $msg; ?>
                        </p>
                    </div>
                    <button type="submit" name="file" class="btn btn-primary d-none" id="file"><i
                            class="fa-solid fa-cloud-arrow-up"></i> Subir</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer-lite: start -->
    <?php require("../footer/footer.lite.php"); ?>
    <!-- Footer-lite: end -->

</body>

</html>

<!-- Script: start -->
<script>

    // Image preview
    const imageInput = document.querySelector('#image');
    const preview = document.querySelector('#preview');
    const previewImg = document.querySelector('#previewImg');
    const file = document.querySelector('#file');
    if (imageInput != null) {
        imageInput.addEventListener('change', () => {
            const selectedFile = imageInput.files[0];
            if (selectedFile) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.setAttribute('src', e.target.result);
                    previewImg.classList.remove('d-none');
                    file.classList.remove('d-none');
                }
                reader.readAsDataURL(selectedFile);
            }
        });
    }

</script>
<!-- Script: end -->

<!-- Styles: start -->
<style>
    .upload-image {
        margin-top: 100px;
    }

    #preview {
        max-width: 100%;
        height: auto;
    }
</style>
<!-- Styles: end -->
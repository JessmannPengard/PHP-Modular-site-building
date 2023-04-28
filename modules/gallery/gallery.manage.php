<?php
// Importamos los modelos necesarios
require_once("../database/database.php");
require_once("../gallery/gallery.model.php");
require_once("../user/user.model.php");

// Conexión a la base de datos
$db = new Database();

// Establecemos la ruta en la que guardamos las imágenes subidas por los usuarios
$directorio_subida = '../../upload/gallery/';

// Inicializamos la variable que guardará el mensaje en caso de posibles errores
$msg = "";

// Si nos han enviado una imagen:
if (isset($_POST["file"])) {
    // Verificamos si se subió un archivo y si no hay errores
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        // Verificamos el tipo de archivo (aquí establecemos los tipos de archivos permitidos)
        $tipos_permitidos = array('image/jpeg', 'image/png');
        if (in_array($_FILES['imagen']['type'], $tipos_permitidos)) {
            // Verificamos el tamaño del archivo, aquí establecemos el tamaño máximo de archivo permitido
            $tamano_maximo = 5 * 1024 * 1024; // 5MB
            if ($_FILES['imagen']['size'] <= $tamano_maximo) {
                // Renombramos el archivo para evitar sobrescribir archivos existentes mediante la función uniqid
                $nombre_archivo = uniqid('imagen_', true) . '.' . pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                // Movemos el archivo a la carpeta de destino que hemos designado ($directorio_subida) con el nuevo nombre de archivo
                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $directorio_subida . $nombre_archivo)) {
                    // El archivo se subió correctamente
                    // Obtenemos los id's de usuario e imagen
                    $usuario = new User($db->getConnection());
                    $imagen = new Gallery($db->getConnection());
                    // Y los guardamos en la base de datos junto con la ruta del archivo que se acaba de subir
                    $imagen->upload($usuario->getId($_SESSION["username"]), $directorio_subida . $nombre_archivo);
                    $msg = "Imagen subida correctamente";
                    // Recargamos la página
                    header("Location: admin.php");
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



<div class="tab-pane fade show active" id="galeria" role="tabpanel" aria-labelledby="galeria-tab">
    <!-- Subir imagen -->
    <div class="container" style="margin: 40px 0;">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <!-- Título del formulario -->
                <h3>Subir imagen</h3>
                <hr>
                <div>
                    <p>PNG o JPEG, tamaño máximo permitido: 5MB</p>
                </div>
                <div class="form-group d-none" id="previsualizarImg">
                    <img id="previsualizacion" src="#" alt="Previsualización de la imagen"
                        style="max-width: 100%; height: auto;">
                </div>
                <form id="formulario" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="file" class="form-control-file" id="imagen" name="imagen"
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

    <!-- Galería -->
    <?php
    require_once("../gallery/gallery.scrolled.php");
    ?>

    <!-- Modal de confirmación de borrado -->
    <div class="modal fade" id="confirmacionModal" tabindex="-1" role="dialog" aria-labelledby="confirmacionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmacionModalLabel">¿Estás seguro?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar esta imagen?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="" class="btn btn-danger" id="confirm-delete">Eliminar</a>
                </div>
            </div>
        </div>
    </div>
</div>
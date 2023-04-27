<?php

require_once("../../modules/database/database.php");
require_once("../../modules/gallery/gallery.model.php");

// Conexión a la base de datos
$db = new Database();

// Obtener el ID de la imagen a borrar
$id = $_GET['id'];

// Crear una instancia de la clase Pictures
$pictures = new Gallery($db->getConnection());

// Borrar la imagen
$pictures->deleteById($id);

// Redirigimos a la administración de la galería
header("Location: ../../admin.php?gallery-page?=1");
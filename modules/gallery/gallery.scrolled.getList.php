<?php

// Requires
require_once("../database/database.php");
require_once("gallery.model.php");

// código para conectarse a la base de datos
$db= new Database;
$pics=new Gallery($db->getConnection());
$images=$pics->getAll();

echo json_encode($images);

?>
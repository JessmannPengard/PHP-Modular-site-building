<?php
// Script para cerrar sesión

// Iniciamos sesión
session_start();
// Al hacer unset, se eliminan las variables de sesión y su valor, 
// por lo que cualquier intento de acceder a estas variables 
// después de cerrar sesión no será posible.
session_unset();
// Destruimos la sesión
session_destroy();

// Redirigimos a la página de login
header("Location: user.login.php");
?>
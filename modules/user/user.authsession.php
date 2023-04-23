<?php
// Comprobamos que haya una sesión iniciada para permitir el acceso
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: ../../modules/user/user.login.php');
    exit();
}
?>
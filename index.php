<?php
include("config/app.php");

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Título -->
    <title>
        <?= BRAND ?>
    </title>
    <!-- Bootstrap -->
    <script src="vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css">
    <!-- Script de idiomas -->
    <script src="js/translations.js"></script>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="favicon.ico">
</head>

<body>

    <!-- Barra de menú -->
    <?php include("modules/nav/nav.php"); ?>

    <!-- Carrusel -->
    <?php include("modules/carousel/carousel.php"); ?>

    <!-- Formulario de contacto -->
    <?php include("modules/contact/contact.php"); ?>

    <!-- Pie de página -->
    <?php include("modules/footer/footer.php"); ?>

</body>

</html>
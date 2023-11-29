<?php
// Config file
require_once("config/app.php");

// Language
require_once("modules/language/language.php");

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
    <script src="vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="img/favicon.ico">
</head>

<body>

    <?php require("modules/nav/nav.php"); ?>

    <?php require("modules/hero/hero.php"); ?>

    <?php require("modules/about/about.php"); ?>

    <?php require("modules/contact/contact.php"); ?>

    <?php require("modules/footer/footer.php"); ?>

    <?php require("modules/cookies/cookies.php"); ?>

</body>

</html>
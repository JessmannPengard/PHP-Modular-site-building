<!-- Index sample by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<?php
// Config file
include("config/app.php");

// Init session
session_start();
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

    <!-- Variables for languages with users -->
    <?php
    if (isset($_SESSION['language'])) {
        $selectedLanguageId = $_SESSION['language'];
    } else {
        $selectedLanguageId = null;
    }
    echo '<script>const sessionLanguage = "' . $selectedLanguageId . '";</script>';
    ?>

    <!-- Language script -->
    <script src="modules/translations/translations.js"></script>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="img/favicon.ico">
</head>

<body>

    <!-- Menu nav -->
    <?php include("modules/nav/nav.php"); ?>

    <!-- Carousel -->
    <?php //include("modules/carousel/carousel.php"); ?>

    <!-- Hero -->
    <?php include("modules/hero/hero.php"); ?>

    <!-- Contact Form -->
    <?php include("modules/contact/contact.php"); ?>

    <!-- Map -->
    <?php include("modules/map/map.php"); ?>

    <!-- Footer -->
    <?php include("modules/footer/footer.php"); ?>

</body>

</html>
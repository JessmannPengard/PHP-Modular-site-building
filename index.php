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

    <?php include("modules/nav/nav.php"); ?>

    <?php include("modules/hero/hero.php"); ?>

    <?php //include("modules/carousel/carousel.php"); ?>

    <?php include("modules/gallery/gallery.paginated.php"); ?>

    <?php include("modules/about/about.php"); ?>

    <?php include("modules/cards/cards-horizontal.php"); ?>

    <?php include("modules/cards/cards-vertical.php"); ?>

    <?php include("modules/contact/contact.php"); ?>

    <?php include("modules/map/map.php"); ?>

    <?php include("modules/footer/footer.php"); ?>

    <?php //include("modules/gallery/gallery.scrolled.php"); ?>

    <?php include("modules/cookies/cookies.php"); ?>

</body>

</html>
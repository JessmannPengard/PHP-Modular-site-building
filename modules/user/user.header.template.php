<!-- User module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<!-- Header template: start -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="../../vendor/bootstrap/css/bootstrap.css">

    <!-- Language variables -->
    <?php
    if (isset($_SESSION['language'])) {
        $selectedLanguageId = $_SESSION['language'];
    } else {
        $selectedLanguageId = null;
    }
    echo '<script>const sessionLanguage = "' . $selectedLanguageId . '";</script>';
    ?>

    <!-- Language script -->
    <script src="../../modules/translations/translations.js"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="user.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../../img/favicon.ico">

    <!-- Title -->
    <title>
        <?= BRAND ?>
    </title>
</head>

<body>
    <!-- Header: start -->
    <?php require("../nav/nav.lite.php"); ?>
    <!-- Header: end -->

<!-- Header template: end -->
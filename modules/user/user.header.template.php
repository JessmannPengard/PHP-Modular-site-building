<!-- User module by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="../../vendor/bootstrap/css/bootstrap.css">

    <!-- Variables necesarias para usar idiomas con usuarios -->
    <?php
    if (isset($_SESSION['language'])) {
        $selectedLanguageId = $_SESSION['language'];
    } else {
        $selectedLanguageId = null;
    }
    echo '<script>const sessionLanguage = "' . $selectedLanguageId . '";</script>';
    ?>

    <!-- Script de idiomas -->
    <script src="../../modules/translations/translations.js"></script>

    <!--Estilos-->
    <link rel="stylesheet" href="user.css">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../../img/favicon.ico">

    <!-- Título de la página -->
    <title>
        <?= BRAND ?>
    </title>
</head>

<body>
    <!-- Encabezado de página -->
    <?php
    require_once("../nav/nav.lite.php");
    ?>
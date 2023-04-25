# Descripción general
La idea detrás de este proyecto es crear un sistema de módulos que permita crear un sitio o aplicación web de manera rápida y simple mediante la adición de módulos base genéricos según las necesidades de cada proyecto.
De este modo aceleramos y facilitamos la creación de un sitio web o aplicación, reduciendo el trabajo a la personalización o adaptación mínima de dichos módulos.
Todos los módulos tienen un diseño responsive, de modo que nos aseguramos de que nuestra aplicación se verá siempre bien en cualquier tipo de pantalla o dispositivo.


# Estructura de carpetas
sitio/
    |____config/
        |____app.php
    |____img/
        |____svg/
            |____svg1.svg
            |____svg2.svg
            |____...
        |____logo.png
        |____favicon.ico
        |____...
    |____modules/
        |____module1/
            |____module1.php
            |____...
        |____module2/
            |____module2.php
            |____...
        |____...
    |____vendor/
        |____bootstrap/
            |____css/
                |____...
            |____js/
                |____...
        |____...
    |____.gitignore
    |____favicon.ico
    |____index.php
    |____readme.md

·/config
    En esta carpeta guardaremos los archivos de configuración generales de nuestra aplicación o sitio web.
        -app.php
            Almacena las constantes globales y generales para toda la aplicación:
            -BRAND: define el nombre de la aplicación o sitio web.

·/img
    Carpeta en la que guardamos las imágenes generales de la aplicación o sitio web:
        logo.png
            El logotipo de nuestra aplicación
        favicon.ico
            Favicon de nuestra aplicación o sitio web
        ·/svg
            Carpeta donde almacenamos todas las imágenes de tipo .svg (esencialmente los iconos de nuestra aplicación)

·/modules
    Esta carpeta contiene cada uno de los módulos que conformarán nuestra aplicación o sitio web. Cada módulo estará contenido a su vez en su propia carpeta que contendrá todo lo necesario para el funcionamiento de dicho módulo.
    En ocasiones, ciertos módulos necesitan de otros para funcionar correctamente. Esto se especificará en la documentación de cada uno de los módulos.
        -CAROUSEL
        -CONTACT
        -DATABASE
        -FOOTER
        -GALLERY
        -HERO
        -MAP
        -NAV
        -PHPMAILER
        -TRANSLATIONS
        -USER

·/vendor
    Aquí guardamos bibliotecas o contenido de terceros que utilizaremos en nuestra aplicación o sitio web:
        ·/bootstrap
            Archivos de bootstrap
                -/css
                    Archivos CSS
                -/js
                    Archivos Javascript

·.gitignore
    Este archivo contiene las referencias a los archivos que NO deben ser subidos al repositorio por contener información sensible, datos de conexión, datos privados que no deben ser públicos.
        -modules/phpmailer/src/mail.config.php
            Archivo de configuración de nuestro servidor SMTP
        -modules/database/database.config.php
            Archivo con los datos de conexión a nuestra base de datos
    Para estos archivos se subirá al repositorio un archivo de ejemplo con el nombre archivo.php.sample

·index.php
    Página de ejemplo utilizando varios de los módulos de nuestra aplicación o sitio web, podemos probar y testear desde aquí los diferentes módulos y su funcionalidad.

·readme.md
    Archivo con toda la documentación y descripción del proyecto.


# Ejemplo de una página web simple con el sistema de módulos
Esta página se compone de una barra de navegación, un carrusel, un formulario de contacto, un mapa de google y un pie de página, además de un sistema de selección de idioma.

```<?php
include("config/app.php");  //Incluimos el archivo de configuración

session_start();    // Iniciamos sesión
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
    <script src="modules/translations/translations.js"></script>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="img/favicon.ico">
</head>

<body>

    <!-- Barra de navegación -->
    <?php include("modules/nav/nav.php"); ?>

    <!-- Carrusel -->
    <?php include("modules/carousel/carousel.php"); ?>

    <!-- Formulario de contacto -->
    <?php include("modules/contact/contact.php"); ?>

    <!-- Mapa de google-->
    <?php include("modules/map/map.php"); ?>

    <!-- Pie de página -->
    <?php include("modules/footer/footer.php"); ?>

</body>

</html>```


# Módulos
## CAROUSEL
### Descripción
### Uso
### Dependencias

## CONTACT
### Descripción
### Uso
### Dependencias

## DATABASE
### Descripción
### Uso
### Dependencias

## FOOTER
### Descripción
### Uso
### Dependencias

## HERO
### Descripción
### Uso
### Dependencias

## MAP
### Descripción
### Uso
### Dependencias

## NAV
### Descripción
### Uso
### Dependencias

## PHPMAILER
https://github.com/PHPMailer/PHPMailer
### Descripción
### Uso
### Dependencias

## TRANSLATIONS
### Descripción
### Uso
### Dependencias

## USER
### Descripción
### Uso
### Dependencias
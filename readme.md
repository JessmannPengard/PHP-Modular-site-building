# Descripción general

La idea detrás de este proyecto es crear un **sistema de módulos** que permita **crear un sitio o aplicación web de manera rápida y simple** mediante la adición de módulos base genéricos según las necesidades de cada proyecto.

De este modo aceleramos y facilitamos la creación de un sitio web o aplicación, reduciendo el trabajo a la personalización o adaptación mínima de dichos módulos.

Todos los módulos tienen un diseño **responsive**, de modo que nos aseguramos de que nuestra aplicación se verá siempre bien en cualquier tipo de pantalla o dispositivo.


# Carpetas y achivos

```
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
	|____upload/
		|____profile/
			|____...
	|____vendor/
		|____bootstrap/
			|____css/
				|____...
			|____js/
				|____...
		|____...
	|____.gitignore
	|____index.php
	|____readme.md
```

## /config

En esta carpeta guardaremos los archivos de configuración generales de nuestra aplicación o sitio web.

**app.php**: almacena las constantes globales y generales para toda la aplicación:

	BRAND: define el nombre de la aplicación o sitio web.

## /img

Carpeta en la que guardamos las imágenes generales de la aplicación o sitio web:

**logo.png**: el logotipo de nuestra aplicación.

**favicon.ico**: favicon de nuestra aplicación o sitio web.

**/svg**: carpeta donde almacenamos todas las imágenes de tipo *.svg* (esencialmente los iconos de nuestra aplicación).

## /modules

Esta carpeta contiene cada uno de los módulos que conformarán nuestra aplicación o sitio web. Cada módulo estará contenido a su vez en su propia carpeta que contendrá todo lo necesario para el funcionamiento de dicho módulo.

En ocasiones, ciertos módulos necesitan de otros para funcionar correctamente. Esto se especificará en la documentación de cada uno de los módulos.

 - *CAROUSEL*
 - *CONTACT*
 - *DATABASE*
 - *FOOTER*
 - *GALLERY*
 - *HERO*
 - *MAP*
 - *NAV*
 - *PHPMAILER*
 - *TRANSLATIONS*
 - *USER*

## /upload

Aquí guardamos los archivos subidos a nuestro sitio por los usuarios.

**/profiles**: imágenes de perfil de los usuarios.


## /vendor

Aquí guardamos bibliotecas o contenido de terceros que utilizaremos en nuestra aplicación o sitio web:

**/bootstrap**: archivos de Bootstrap.


## .gitignore

Este archivo contiene las referencias a los archivos que **NO** deben ser subidos al repositorio por contener *información sensible, datos de conexión, datos privados que no deben ser públicos*:

**modules/phpmailer/src/mail.config.php**: archivo de configuración de nuestro servidor SMTP.

**modules/database/database.config.php**: archivo con los datos de conexión a nuestra base de datos

*Para estos archivos se subirá al repositorio un archivo de ejemplo con el nombre archivo.php.sample.*

## index.php

Página de ejemplo utilizando varios de los módulos de nuestra aplicación o sitio web, podemos probar y testear desde aquí los diferentes módulos y su funcionalidad.

## readme.md

Archivo con toda la documentación y descripción del proyecto.



# Ejemplo de una página web simple con el sistema de módulos

Esta página se compone de una barra de navegación, un carrusel, un formulario de contacto, un mapa de google y un pie de página, además de un sistema de selección de idioma y un acceso y registro de usuarios.

    <?php
    include("config/app.php"); //Incluimos el archivo de configuración
    
    session_start(); // Iniciamos sesión
    ?>
    
    <!DOCTYPE  html>
    <html  lang="en">
    
    <head>
	    <meta  charset="UTF-8">
	    <meta  http-equiv="X-UA-Compatible"  content="IE=edge">
	    <meta  name="viewport"  content="width=device-width, initial-scale=1.0">
	    <!-- Título -->
	    <title>
		    <?= BRAND ?>
	    </title>
	    <!-- Bootstrap -->
	    <script  src="vendor/bootstrap/js/bootstrap.bundle.js"></script>
	    <link  rel="stylesheet"  href="vendor/bootstrap/css/bootstrap.css">
	    <!-- Asignar el idioma de la sesión a una variable PHP (para usar en el nav) y una variable JavaScript para usar en translations.js -->
        <?php
        if (isset($_SESSION['language'])) {
            $selectedLanguageId = $_SESSION['language'];
        } else {
            $selectedLanguageId = null;
        }
        echo '<script>const sessionLanguage = "' . $selectedLanguageId . '";</script>';
        ?>
        <!-- Script de idiomas -->
        <script src="modules/translations/translations.js"></script>
	    <!-- Favicon -->
	    <link  rel="icon"  type="image/png"  href="img/favicon.ico">
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
    
    </html>


# Módulos

## Carousel
### Descripción
Un carrusel de imágenes simple con Bootstrap.
### Uso
Simplemente incrustar en tu página y listo:

    <?php  include("modules/carousel/carousel.php"); ?>

Recuerda revisar la ruta en función de la estructura de tu sitio.
Las imágenes se guardan dentro de la carpeta *carousel/img/*, en el propio módulo.

## Contact
### Descripción
### Uso
### Dependencias

## Database
### Descripción
### Uso
### Dependencias

## Footer
### Descripción
### Uso
### Dependencias

## Hero
### Descripción
### Uso
### Dependencias

## Map
### Descripción
### Uso
### Dependencias

## Nav
### Descripción
### Uso
### Dependencias

## PHPMailer
### Descripción
[PHPMailer](https://github.com/PHPMailer/PHPMailer)
### Uso
### Dependencias

## Translations
### Descripción
Este módulo permite la utilización de diferentes idiomas en tu sitio.
Consiste en un script que traduce los diferentes elementos en función del idioma seleccionado.
### Uso

 Para poder utilizar la traducción en tu sitio, hay varios requisitos básicos: 

 - Dentro de la carpeta del módulo *translations/lang* debes    incluir
   los archivos de idiomas en formato *json* con el siguiente   
   formato:
  
       {
       "home": "Home",
       "about": "About",
       "contact": "Contact",
       "login": "Login"
       }
	Este archivo se llamaría, por ejemplo *en.json*.
 - Además, si vas a usar el *plugin* del módulo *nav* para seleccionar
   el idioma, debes incluir la imagen de la bandera correspondiente al
   idioma que en este caso sería *en.png*. Y así para el resto de
   idiomas: *es.json*, *es.png*, etc.
   
 - Cada texto que desees traducir    debe incluir el atributo
   *data-i18n* con la *key* correspondiente del    archivo de idioma *json*:
      
          <label data-i18n="home">Home</label>

Dependiendo del sitio que estés construyendo, el manejo de idiomas se puede utilizar de dos formas diferentes:
#### Sitios SIN usuarios registrados
El idioma se guardará en LocalStorage. Una vez que el usuario selecciona un idioma, este se almacenará en su máquina local y cada vez que acceda al sitio, utilizará este valor para traducir la página. Para ello sólo será necesario añadir el script a cada página:

    <script  src="modules/translations/translations.js"></script>

La ruta puede variar en función de la estructura de tu sitio.

#### Sitios CON usuarios registrados
En este caso, los requisitos son los mismos, con la diferencia de que el idioma se puede guardar a nivel de usuario en la base de datos. El sistema buscará el idioma seleccionado por este orden:

 - Sesión
 - LocalStorage
 - Default ("en")

En este caso debemos incluir en nuestra página:

    <?php
    if (isset($_SESSION['language'])) {
    $selectedLanguageId = $_SESSION['language'];
    } else {
    $selectedLanguageId = null;
    }
    echo  '<script>const sessionLanguage = "'  .  $selectedLanguageId  .  '";</script>';
    ?>
    <script  src="modules/translations/translations.js"></script>

De nuevo, la ruta del script puede variar en función de la estructura de tu sitio.
### Dependencias
Este módulo no necesita de ningún otro para funcionar, no obstante se puede combinar con el plugin *language.plugin.php* del módulo *nav* para tener una funcionalidad completa.

## User
### Descripción
### Uso
### Dependencias

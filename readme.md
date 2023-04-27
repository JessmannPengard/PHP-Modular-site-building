# Descripción general
La idea detrás de este proyecto es crear un **sistema de módulos** que permita **crear un sitio o aplicación web de manera rápida y simple** mediante la adición de módulos base genéricos según las necesidades de cada proyecto.

De este modo aceleramos y facilitamos la creación de un sitio web o aplicación, reduciendo el trabajo a la personalización o adaptación mínima de dichos módulos.

Todos los módulos tienen un diseño **responsive**, de modo que nos aseguramos de que nuestra aplicación se verá siempre bien en cualquier tipo de pantalla o dispositivo.

*Este proyecto continúa en desarrollo e iré incorporando nuevos módulos y tratando de mejorar y optimizar los existentes.*

# Estructura del proyecto
```
site/
├──config/
│	├── app.php
├──img/
│	├── svg/
│	│	├── svg1.svg
│	│	├── svg2.svg
│	│	├──...
│	├── logo.png
│	├── favicon.ico
│	├──	...
├──modules/
│	├── module1/
│	│	├── module1.php
│	│	├── ...
│	├── module2/
│	│	├── module2.php
│	│	├── ...
│	├── ...
├──upload/
│	├── profile/
│	│	├──...
│	├──...
├──vendor/
│	├── bootstrap/
│		├── css/
│		│	├── ...
│		├── js/
│			├── ...
├──.gitignore
├──index.php
└──readme.md
```

## config/

En esta carpeta guardaremos los archivos de configuración generales de nuestra aplicación o sitio web.

**app.php**: almacena las constantes globales y generales para toda la aplicación:

- BRAND: define el nombre de la aplicación o sitio web.

## img/

Carpeta en la que guardamos las imágenes generales de la aplicación o sitio web:

**logo.png**: el logotipo de nuestra aplicación.

**favicon.ico**: *favicon* de nuestra aplicación o sitio web.

**svg/**: carpeta donde almacenamos todas las imágenes de tipo *.svg* (esencialmente los iconos de nuestra aplicación).

## modules/

Esta carpeta contiene cada uno de los módulos que conformarán nuestra aplicación o sitio web. Cada módulo estará contenido a su vez en su propia carpeta que contendrá todo lo necesario para el funcionamiento de dicho módulo.

En ocasiones, ciertos módulos necesitan de otros para funcionar correctamente. Esto se especificará en la documentación de cada uno de los módulos.

-  *ABOUT (en desarrollo)*
-  *CARDS (en desarrollo)*
-  *CAROUSEL*
-  *CONTACT*
-  *DATABASE*
-  *FOOTER*
-  *GALLERY (en desarrollo)*
-  *HERO (en desarrollo)*
-  *MAP*
-  *NAV*
-  *PHPMAILER*
-  *TRANSLATIONS*
-  *USER*

## upload/

Aquí guardamos los archivos subidos a nuestro sitio por los usuarios.

**profiles/**: imágenes de perfil de los usuarios.

## vendor/

Aquí guardamos bibliotecas o contenido de terceros que utilizaremos en nuestra aplicación o sitio web:

**bootstrap/**: archivos de Bootstrap.

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

Esta página se compone de una barra de navegación, un carrusel, un formulario de contacto, un mapa de *google* y un pie de página, además de un sistema de selección de idioma y un acceso y registro de usuarios.

```php
<?php
include("config/app.php"); //Incluimos el archivo de configuración
session_start(); // Iniciamos sesión
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
</html>
```

# Módulos

## About

### Descripción

*En desarrollo.*

### Uso

### Dependencias

## Cards

### Descripción

*En desarrollo.*

### Uso

### Dependencias

## Carousel

### Descripción

Un carrusel de imágenes simple con Bootstrap.

### Uso

Simplemente incrustar en tu página y listo:

```php
<? php include("modules/carousel/carousel.php"); ?>
```
Recuerda revisar la ruta en función de la estructura de tu sitio.

Las imágenes se guardan dentro de la carpeta *carousel/img/*, en el propio módulo.

## Contact

### Descripción

Permite el envío de correo electrónico al administrador de la página.

### Uso

Simplemente incluir el módulo en el lugar deseado de la página:

```php
<? php include("modules/contact/contact.php"); ?>
```

### Dependencias

Este módulo requiere la inclusión en el proyecto del módulo **phpmailer**.

## Database

### Descripción

Este módulo es muy simple. Lo utilizamos para conectarnos a una base de datos. Lo incluiremos siempre que necesitemos una conexión con alguna base de datos.

### Uso

En el archivo *database.config.php* debemos definir los datos de configuración de la conexión a nuestra base de datos. Se incluye el archivo *database.config.php.sample* como ejemplo.

Instanciamos la clase Database y esta dispone de dos métodos: *getConnection()* y *closeConnection()*:

```php
<?php
require("modules/database/database.php");
require("modules/user/user.model.php");

$db = new Database();
$user = new User($db->getConnection());
?>
```

### Dependencias

Ninguna.

## Footer

### Descripción

Otro módulo muy sencillo. En este caso (al igual que con el nav) disponemos de dos versiones, una completa y una *lite*. El uso de uno u otro dependerá de las características del sitio que estemos construyendo. Podemos usar los dos, el completo para la página principal y el *lite* para páginas segundarias o auxiliares.

### Uso

```php
<?php include("modules/footer/footer.php"); ?>
```

```php
<?php include("modules/footer/footer.lite.php"); ?>
```

### Dependencias

Ninguna.

## Gallery

### Descripción

*En desarrollo.*

### Uso

### Dependencias

## Hero

### Descripción

*En desarrollo.*

### Uso

### Dependencias

## Map

### Descripción

Un mapa de *google* sin más. He añadido un overlay que permite oscurecer o tintar el mapa según la apariencia del sitio que estés construyendo.

### Uso

Incrustar y listo. Asegúrate de cambiar la ubicación del mapa según la ubicación que desees mostrar.

```php
<?php include("modules/map/map.php"); ?>
```

### Dependencias

Ninguna.

## Nav

### Descripción

La barra de navegación cuenta con dos versiones al igual que el *footer*, completa y *lite*.

La versión *lite* simplemente muestra el *BRAND*, ya sea imagen, texto o ambas.

La versión completa además del *BRAND* incluye un menú de navegación tradicional *responsive*. Además dispone de dos *plugins* que podemos utilizar dependiendo del sitio que estemos construyendo:

#### language.plugin.php

Para sitios con distintos idiomas, es un selector de idioma que guarda el idioma seleccionado en localStorage.

#### session.plugin.php

Para sitios que permiten registro e inicio de sesión de usuarios. Muestra las diferentes opciones en función de si se ha iniciado sesión o no.

### Uso

Incluir la versión deseada:

```php
<?php include("modules/nav/nav.php"); ?>
```

```php
<?php include("modules/nav/nav.lite.php"); ?>
```

La versión completa incluye los *plugins* de sesión e idioma:

```php
<?php
require("plugins/session.plugin.php");
require("plugins/language.plugin.php");
?>

```
Si no se van a utilizar, pueden eliminarse o comentarse.

### Dependencias

El *plugin* de sesión requiere de los módulos *user* y *database*.

El *plugin* de idioma requiere el módulo *translations*.

## PHPMailer

### Descripción

Para el mailing utilizo la biblioteca  [PHPMailer](https://github.com/PHPMailer/PHPMailer "Github").

### Uso
Para su uso puedes consultar su [Github](https://github.com/PHPMailer/PHPMailer "Github").

### Dependencias
Ninguna.

## Translations

### Descripción

Este módulo permite la utilización de diferentes idiomas en tu sitio.

Consiste en un script que traduce los diferentes elementos en función del idioma seleccionado.

### Uso

Para poder utilizar la traducción en tu sitio, hay varios requisitos básicos:

- Dentro de la carpeta del módulo *translations/lang* debes incluir los archivos de idiomas en formato *json* con el siguiente formato:

```json
{
"home": "Inicio",
"about": "Acerca de",
"contact": "Contacto",
"login": "Iniciar sesión"
}
```

Este archivo se llamaría, por ejemplo *es.json*.

- Además, si vas a usar el *plugin* del módulo *nav* para seleccionar el idioma, debes incluir la imagen de la bandera correspondiente al idioma que en este caso sería *es.png*. Y así para el resto de idiomas: *en.json*, *en.png*, etc.

- Cada texto que desees traducir debe incluir el atributo *data-i18n* con la *key* correspondiente del archivo de idioma *json*:

```html
<label data-i18n="home">Home</label>
```

- En el caso de que generes el texto de manera dinámica (por ejemplo para mostrar mensajes de error) mediante javascript, puedes utilizar la función *translate(key)*:

```javascript
translate("mailer error");
```

Debes tener cargado el módulo *translations* para que funcione, para evitar errores podrías hacer la comprobación de este modo:

```javascript
let texto = translations ? translate("mailer error") : "Message could not be sent. Mailer Error;
```

Dependiendo del sitio que estés construyendo, el manejo de idiomas se puede utilizar de dos formas diferentes:

##### Sitios SIN usuarios registrados

El idioma se guardará en LocalStorage. Una vez que el usuario selecciona un idioma, este se almacenará en su máquina local y cada vez que acceda al sitio, utilizará este valor para traducir la página. Para ello sólo será necesario añadir el script a cada página:

```html
<script src="modules/translations/translations.js"></script>
```

La ruta puede variar en función de la estructura de tu sitio.

##### Sitios CON usuarios registrados

En este caso, los requisitos son los mismos, con la diferencia de que el idioma se puede guardar a nivel de usuario en la base de datos. El sistema buscará el idioma seleccionado por este orden:

- Sesión
- LocalStorage
- Default ("en")

En este caso debemos incluir en nuestra página:

```php
<?php
if (isset($_SESSION['language'])) {
	$selectedLanguageId = $_SESSION['language'];
} else {
	$selectedLanguageId = null;
}

echo '<script>const sessionLanguage = "' . $selectedLanguageId . '";</script>';
?>

<script src="modules/translations/translations.js"></script>

```

De nuevo, la ruta del script puede variar en función de la estructura de tu sitio.

### Dependencias

Este módulo no necesita de ningún otro para funcionar, no obstante se puede combinar con el plugin *language.plugin.php* del módulo *nav* para tener una funcionalidad completa.

## User

### Descripción

Este módulo se encarga de la gestión de usuarios. Las funciones incluidas son:

 - Registro
 - Login
 - Logout
 - Autorización de sesión
 - Recuperación de contraseña
 - Configuración de la cuenta

### Uso

 - *Registro*

Simplemente debemos enlazar a *modules/user/user.register.php*

 - *Login*

Simplemente debemos enlazar a *modules/user/user.login.php*

 - *Logout*

Cierra sesión enlazando a *modules/user/user.logout.php*, una vez cerrada la sesión, el script nos redirige a la página de *login*.

 - *Autorización de sesión*

```php
<? php require("user.authsession.php"); ?>
```

Incluye este código al inicio de la página que necesite que el usuario haya iniciado sesión. Si no es así nos redirige a la página de *login*.

 - *Recuperación de contraseña*

*modules/user/user.passwordrecovery.php* se encarga de esta tarea. Envía un enlace al email del usuario con un token para verificar su identidad. Este enlace nos enviará a *modules/user/user.passwordreset.php*, que permitirá al usuario establecer su nueva contraseña.

 - *Configuración de la cuenta*

Aquí el usuario puede configurar los detalles de su cuenta: *modules/user/user.settings.php*

### Dependencias
Es imprescindible el módulo *database*. Además necesitamos el módulo *phpmailer* para disponer de la funcionalidad de recuperación de contraseña.
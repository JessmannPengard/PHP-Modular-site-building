
------------

[*English version*](#item1)

[*Versión en español*](#item2)

------------

<a name="item1"></a>
# About this project

The idea behind this project is to create a **module system** that allows for the **quick and simple creation of a website or web application** by adding generic base modules according to the needs of each project.

In this way, we accelerate and facilitate the creation of a website or application, reducing the work to minimum customization or adaptation of these modules.

All modules have a **responsive** design, ensuring that our application will always look good on any type of screen or device.

*This project is still in development and I will be adding new modules and trying to improve and optimize the existing ones.*

# Project structure

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

In this folder, we will store the general configuration files for our application or website.

**app.php**: it stores the global and general constants for the entire application.

- BRAND: defines the name of the application or website.

## img/

Folder where we store the general images of the application or website:

**logo.png**: the logo of our application.

**favicon.ico**: *favicon* of our application or website.

**svg/**: Folder where we store all the *.svg* type images (essentially the icons of our application).

## modules/

This folder contains each of the modules that will make up our application or website. Each module will be contained in its own folder that will contain everything necessary for the operation of that module.

Sometimes, certain modules require others to function properly. This will be specified in the documentation of each module.

-  *ABOUT*
-  *CARDS*
-  *CAROUSEL*
-  *CONTACT*
-  *DATABASE*
-  *FOOTER*
-  *GALLERY*
-  *HERO*
-  *LANGUAGE*
-  *MAIL*
-  *MAP*
-  *NAV*
-  *USER*

## upload/

Here we store the files uploaded to our site by users.

**profiles/**: profile pictures of the users.

## vendor/

Here we store third-party libraries or content that we will use in our application or website:

**bootstrap/**: Bootstrap files.

## .gitignore

This file contains references to the files that **SHOULD NOT** be uploaded to the repository because they contain *sensitive information, connection data, private data that should not be public*:

**modules/phpmailer/src/mail.config.php**: SMTP server configuration file.

**modules/database/database.config.php**: File with the connection data to our database.

*For these files, an example file named file.php.sample will be uploaded to the repository.*

## index.php

Example page using several modules of our application or website, we can test and try out the different modules and their functionality from here.

## readme.md

File with all the documentation and description of the project.

# Example of a simple website using the module system

This page consists of a navigation bar, a carousel, a contact form, a *Google* map, and a footer, as well as a language selection system and user login and registration.

```php
<!-- Index sample by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<?php
// Config file
require_once("config/app.php");

// Start session if not started yet
session_status() == PHP_SESSION_NONE ? session_start() : null;

//Language
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

    <?php require("modules/cards/cards-horizontal.php"); ?>

    <?php require("modules/cards/cards-vertical.php"); ?>

    <?php require("modules/contact/contact.php"); ?>

    <?php require("modules/map/map.php"); ?>

    <?php require("modules/footer/footer.php"); ?>

    <?php require("modules/cookies/cookies.php"); ?>

</body>

</html>
```

# Modules

## About

### Description

A simple template for an *About* section. It consists of a text section with a title, subtitle, and description, and an image section, usually for a personal photo on a website.

### Usage

```php
<?php include("modules/about/about.php"); ?>
```

### Dependencies

None.

## Cards

### Description

This module includes a couple of *Bootstrap card* templates for various uses: displaying products, portfolios, skills, etc.
*cards-horizontal.php*: presents a horizontal card layout with an image on the left and text on the right.
*cards-vertical.php*: has a standard layout with image, title, description, and a footer (in this case including hyperlinks).

### Usage

Simply include and customize as needed:
```php
<?php include("modules/cards/cards-horizontal.php"); ?>
```

```php
<?php include("modules/cards/cards-vertical.php"); ?>
```

### Dependencies

None.

## Carousel

### Description

A simple image carousel with Bootstrap.

### Usage

Just embed it in your page and you're done:

```php
<? php include("modules/carousel/carousel.php"); ?>
```
Remember to review the path based on your site's structure.

The images are stored within the *carousel/img/* folder, within the module itself.

### Dependencies

None.

## Contact

### Description

This module enables the sending of email to the page administrator.

### Usage

Just include the module in the desired location on the page:

```php
<? php include("modules/contact/contact.php"); ?>
```

### Dependencies

This module requires the inclusion of the **mail** module in the project.

## Database

### Description

This module is very simple. We use it to connect to a database. We will include it whenever we need a connection to any database.

### Usage

In the *database.config.php* file, we need to define the configuration data for the connection to our database. The *database.config.php.sample* file is included as an example.

We instantiate the Database class, which has two methods: *getConnection()* and *closeConnection()*:

```php
<?php
require("modules/database/database.php");
require("modules/user/user.model.php");

$db = new Database();
$user = new User($db->getConnection());
?>
```

### Dependencies

None.

## Footer

### Description

Another very simple module. In this case (like with the *nav*), we have two versions, a full and a *lite* one. The use of one or the other will depend on the characteristics of the site we are building. We can use both, the full one for the main page and the *lite* one for secondary or auxiliary pages.

### Usage

```php
<?php include("modules/footer/footer.php"); ?>
```

```php
<?php include("modules/footer/footer.lite.php"); ?>
```

### Dependencies

None.

## Gallery

### Description

This module includes two gallery templates: one with pagination and the other that loads images as the user scrolls down. Additionally, I have added a page with the logic for uploading images (not yet translated).

### Usage
We need to include the desired gallery in the section of our page where we want to display the gallery:

```php
<?php include("modules/gallery/gallery.paginated.php"); ?>
```

```php
<?php include("modules/gallery/gallery.scrolled.php"); ?>
```

The page to upload images:

```php
<?php include("modules/gallery/gallery.upload.php"); ?>
```

In this case, it is necessary to be logged in to access the page.

### Dependencies

It requires the **database** module to retrieve the images. If we use *image uploading*, we also need the **user** module.

## Hero

### Description

A Hero section for our website, with an image that covers the entire screen. It can be combined with the nav to achieve different effects.

### Usage

```php
<?php include("modules/hero/hero.php"); ?>
```

### Dependencies

None.

## Language

### Description

This module allows the use of different languages on your site. 

It will load the corresponding texts according to the selected language.

### Usage

To be able to use translation on your website, there are several basic requirements:

- Inside the module folder *language/lang*, you must include the language files in *json* format with the following format:

```json
{
"home": "Inicio",
"about": "Acerca de",
"contact": "Contacto",
"login": "Iniciar sesión"
}
```

This file would be named, for example, es.json.

Additionally, if you are going to use the nav module's plugin to select the language, you must include the flag image corresponding to the language, which in this case would be es.png. And so for the rest of the languages: en.json, en.png, etc.

In the language.config.php file we define the languages that our application will support, the languages by country (if we have the Geoip extension installed), and the default language:

```php
<?php
// Define supported languages
$supported_languages = array('es', 'en');

// Define languages by country
$languages_by_country = array(
    'es' => array('AR', 'BO', 'CL', 'CO', 'CR', 'CU', 'DO', 'EC', 'SV', 'GQ', 'GT', 'HN', 'MX', 'NI', 'PA', 'PY', 'PE', 'PR', 'ES', 'UY', 'VE'),
    'en' => array('AU', 'BS', 'CA', 'GB', 'HK', 'IE', 'IN', 'JM', 'MY', 'NZ', 'PH', 'SG', 'ZA', 'US')
);

// Define default language
$default_language = 'en';
```

To display the text, it is done in the following way:

##### PHP

```php
echo $lang[key];
```

##### Javascript

```javascript
console.log(lang[key]);
```

To use this module, simply include it at the beginning of our script:

```php
require_once("modules/language/language.php");

```

### Dependencies

This module doesn't require any other module to work, however, it can be combined with the *language.plugin.php* plugin from the **nav** module to have complete functionality.

## Mail

### Description

For mailing, I use the PHPMailer library [PHPMailer](https://github.com/PHPMailer/PHPMailer "Github"). I have created a Mail class to interact with the library.

### Usage

There are two ways to use this functionality:
- Through the Mail class and its methods:

```php
$mail = new Mail();
if ($mail->sendMail($fromEmail, $fromName, $toEmail, $subject, $body)) {
            // Success
        } else {
            // Error
        }
```

- By using the sendMail.php script:

```php
fetch('modules/mail/sendMail.php', {
	method: 'POST',
	headers: {
		'Content-Type': 'application/x-www-form-urlencoded'
	},
	body: new URLSearchParams({
		fromName: 'John',
		fromEmail: 'john@example.com',
		toEmail: 'recipient@example.com',
		subject: 'Test email',
		body: 'Test message'
	})
})
	.then(response => response.json())
	.then(data => {
		if (data.succeed) {
		// Success
		} else {
		// Error
		}
	})
	.catch(error => console.error(error));
```

### Dependencies

The **PHPMailer** library, which is included in the module. For more information you can visit the [official repository](https://github.com/PHPMailer/PHPMailer "Github").

## Map

### Description

A *Google map*, nothing more. I have added an overlay that allows you to darken or tint the map according to the appearance of the site you are building.

### Usage

Just embed it and you're done. Make sure to change the location of the map according to the location you want to show.

```php
<?php include("modules/map/map.php"); ?>
```

### Dependencies

None.

## Nav

### Description

The navigation bar has two versions just like the footer, full and *lite*.

The *lite* version simply displays the *BRAND*, whether it's an image, text, or both.

The full version, in addition to the *BRAND*, includes a traditional *responsive* navigation menu. It also has two *plugins* that we can use depending on the site we are building:

#### language.plugin.php

For sites with different languages, there is a language selector that saves the selected language in session.

#### session.plugin.php

For sites that allow user registration and login, it displays the different options depending on whether the user is logged in or not.

### Usage

Include the desired version:

```php
<?php include("modules/nav/nav.php"); ?>
```

```php
<?php include("modules/nav/nav.lite.php"); ?>
```

The full version includes the language and session *plugins*:

```php
<?php
require("plugins/session.plugin.php");
require("plugins/language.plugin.php");
?>

```
If they are not going to be used, they can be removed or commented out.

### Dependencies

The *session plugin* requires the **user** and **database** modules.

The *language plugin* requires the **language** module.

## User

### Description

This module is responsible for user management. The included functions are:

- Registration
- Login
- Logout
- Session authorization
- Password recovery
- Account settings.

### Usage

 - *Registration*

To use this module, simply link to *modules/user/user.register.php*

 - *Login*

Simply link to *modules/user/user.login.php*

 - *Logout*

Log out by linking to *modules/user/user.logout.php*. Once the session is closed, the script redirects us to the *login* page.

 - *Session authorization*

```php
<? php require("user.authsession.php"); ?>
```

Include this code at the beginning of the page that requires the user to be logged in. If the user is not logged in, they will be redirected to the *login* page.

 - *Password recovery*

*modules/user/user.passwordrecovery.php* is responsible for this task. It sends a link to the user's email with a token to verify their identity. This link will take us to *modules/user/user.passwordreset.php*, which will allow the user to set their new password.

 - *Account settings*

Here the user can configure the details of their account: *modules/user/user.settings.php*.

### Dependencies

The **database** module is essential. Additionally, we need the **mail** module to have password recovery functionality.

------------


<a name="item2"></a>
# Acerca de este proyecto

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

-  *ABOUT*
-  *CARDS*
-  *CAROUSEL*
-  *CONTACT*
-  *DATABASE*
-  *FOOTER*
-  *GALLERY*
-  *HERO*
-  *LANGUAGE*
-  *MAIL*
-  *MAP*
-  *NAV*
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

**modules/database/database.config.php**: archivo con los datos de conexión a nuestra base de datos.

*Para estos archivos se subirá al repositorio un archivo de ejemplo con el nombre archivo.php.sample.*

## index.php

Página de ejemplo utilizando varios de los módulos de nuestra aplicación o sitio web, podemos probar y testear desde aquí los diferentes módulos y su funcionalidad.

## readme.md

Archivo con toda la documentación y descripción del proyecto.

# Ejemplo de una página web simple con el sistema de módulos

Esta página se compone de una barra de navegación, un carrusel, un formulario de contacto, un mapa de *google* y un pie de página, además de un sistema de selección de idioma y un acceso y registro de usuarios.

```php
<!-- Index sample by Jessmann (https://jessmann.com - https://github.com/JessmannPengard) -->

<?php
// Config file
require_once("config/app.php");

// Start session if not started yet
session_status() == PHP_SESSION_NONE ? session_start() : null;

//Language
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

    <?php require("modules/cards/cards-horizontal.php"); ?>

    <?php require("modules/cards/cards-vertical.php"); ?>

    <?php require("modules/contact/contact.php"); ?>

    <?php require("modules/map/map.php"); ?>

    <?php require("modules/footer/footer.php"); ?>

    <?php require("modules/cookies/cookies.php"); ?>

</body>

</html>
```

# Módulos

## About

### Descripción

Una base sencilla para una sección *Acerca de*. Se compone de una parte de texto, con título, subtítulo y descripción, y una parte de imagen, habitualmente para la foto en caso de una web personal.

### Uso

```php
<?php include("modules/about/about.php"); ?>
```

### Dependencias

Ninguna.

## Cards

### Descripción

Este módulo incluye un par de plantillas de *cards* de *bootstrap* para diferentes usos: mostrar productos, portfolio, skills, etc.
*cards-horizontal.php:* presenta una configuración horizontal de las *cards*, con una imagen a la izquierda y el texto a la derecha.
*cards-vertical.php:* con una configuración estándar, imagen, título, descripción y un pie (en este caso incluye hipervínculos).

### Uso

Simplemente incluir y personalizar según las necesidades:
```php
<?php include("modules/cards/cards-horizontal.php"); ?>
```

```php
<?php include("modules/cards/cards-vertical.php"); ?>
```

### Dependencias

Ninguna.

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

### Dependencias

Ninguna.

## Contact

### Descripción

Permite el envío de correo electrónico al administrador de la página.

### Uso

Simplemente incluir el módulo en el lugar deseado de la página:

```php
<? php include("modules/contact/contact.php"); ?>
```

### Dependencias

Este módulo requiere la inclusión en el proyecto del módulo **mail**.

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

Este módulo incluye dos plantillas de galerías: una paginada y otra que va cargando imágenes al hacer scroll. Adicionalmente he añadido una página con la lógica para subir imágenes (todavía sin traducir).

### Uso
Hay que incluir la galería deseada en la parte de nuestra página en la que queramos mostrar la galería:

```php
<?php include("modules/gallery/gallery.paginated.php"); ?>
```

```php
<?php include("modules/gallery/gallery.scrolled.php"); ?>
```

La página para subir imágenes:

```php
<?php include("modules/gallery/gallery.upload.php"); ?>
```

En este caso es necesario tener iniciada sesión para poder acceder a la página.

### Dependencias

Requiere del módulo **database** para recuperar las imágenes. Si usamos la *subida de imágenes* necesitamos también el módulo **user**.

## Hero

### Descripción

Una sección Hero para nuestra web, con una imagen que ocupa la totalidad de la pantalla. Se puede combinar con el nav para lograr diferentes efectos.

### Uso

```php
<?php include("modules/hero/hero.php"); ?>
```

### Dependencias

Ninguna.

## Language

### Descripción

Este módulo permite la utilización de diferentes idiomas en tu sitio.

Cargará los textos correspondientes según el idioma seleccionado.

### Uso

Para poder utilizar la traducción en tu sitio, hay varios requisitos básicos:

- Dentro de la carpeta del módulo *language/lang* debes incluir los archivos de idiomas en formato *json* con el siguiente formato:

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

- En el archivo *language.config.php* definimos los idiomas que soportará nuestra aplicación, los idiomas por país (si tenemos instalada la extensión *Geoip*) y el idioma por defecto:

```php
<?php
// Define supported languages
$supported_languages = array('es', 'en');

// Define languages by country
$languages_by_country = array(
    'es' => array('AR', 'BO', 'CL', 'CO', 'CR', 'CU', 'DO', 'EC', 'SV', 'GQ', 'GT', 'HN', 'MX', 'NI', 'PA', 'PY', 'PE', 'PR', 'ES', 'UY', 'VE'),
    'en' => array('AU', 'BS', 'CA', 'GB', 'HK', 'IE', 'IN', 'JM', 'MY', 'NZ', 'PH', 'SG', 'ZA', 'US')
);

// Define default language
$default_language = 'en';
```

Para mostrar el texto se hace de la siguiente manera:

##### PHP

```php
echo $lang[key];
```

##### Javascript

```javascript
console.log(lang[key]);
```

Para utilizar este módulo simplemente hay que incluirlo al inicio de nuestro script:

```php
require_once("modules/language/language.php");

```

### Dependencias

Este módulo no necesita de ningún otro para funcionar, no obstante se puede combinar con el plugin *language.plugin.php* del módulo **nav** para tener una funcionalidad completa.

## Mail

### Descripción

Para el mailing utilizo la biblioteca  [PHPMailer](https://github.com/PHPMailer/PHPMailer "Github"). He creado una clase Mail para interactuar con la biblioteca.

### Uso

Hay dos maneras de utilizar esta funcionalidad:
- Mediante la clase Mail y sus métodos:

```php
$mail = new Mail();
if ($mail->sendMail($fromEmail, $fromName, $toEmail, $subject, $body)) {
            // Success
        } else {
            // Error
        }
```

- Mediante el script sendMail.php:

```php
fetch('modules/mail/sendMail.php', {
	method: 'POST',
	headers: {
		'Content-Type': 'application/x-www-form-urlencoded'
	},
	body: new URLSearchParams({
		fromName: 'John',
		fromEmail: 'john@example.com',
		toEmail: 'recipient@example.com',
		subject: 'Test email',
		body: 'Test message'
	})
})
	.then(response => response.json())
	.then(data => {
		if (data.succeed) {
		// Success
		} else {
		// Error
		}
	})
	.catch(error => console.error(error));
```

### Dependencias

La biblioteca **PHPMailer**, que se encuentra incluida dentro del módulo. Para más información puedes visitar el [Repositorio oficial](https://github.com/PHPMailer/PHPMailer "Github").

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

Para sitios con distintos idiomas, es un selector de idioma que guarda el idioma seleccionado en sesión.

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

El *plugin* de sesión requiere de los módulos **user** y **database**.

El *plugin* de idioma requiere el módulo **language**.

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

Es imprescindible el módulo **database**. Además necesitamos el módulo **mail** para disponer de la funcionalidad de recuperación de contraseña.
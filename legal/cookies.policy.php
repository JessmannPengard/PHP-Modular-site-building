<?php

require("../config/app.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <script src="../vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css">

    <title>
        <?= BRAND ?>
    </title>
</head>

<body>

    <?php include("../modules/nav/nav.lite.php"); ?>

    <section id="cookies-policy-section">
        <h4>POLÍTICA DE COOKIES</h4>
        <p>
            <?= BRAND ?> informa acerca del uso de las cookies en su página web:
            <?= SITE_URL ?>
        </p>

        <h5>¿Qué son las cookies?</h5>
        <p>Las cookies son archivos que se pueden descargar en su equipo a través de las páginas
            web. Son herramientas que tienen un papel esencial para la prestación de numerosos
            servicios de la sociedad de la información. Entre otros, permiten a una página web
            almacenar y recuperar información sobre los hábitos de navegación de un usuario o de
            su equipo y, dependiendo de la información obtenida, se pueden utilizar para
            reconocer al usuario y mejorar el servicio ofrecido.</p>
        <h5>Tipos de cookies</h5>
        <p>Según quien sea la entidad que gestione el dominio desde donde se envían las cookies
            y trate los datos que se obtengan se pueden distinguir dos tipos:</p>
        <ul>
            <li>Cookies propias: aquéllas que se envían al equipo terminal del usuario desde un
                equipo o dominio gestionado por el propio editor y desde el que se presta el
                servicio solicitado por el usuario.</li>
            <li>Cookies de terceros: aquéllas que se envían al equipo terminal del usuario
                desde un equipo o dominio que no es gestionado por el editor, sino por otra
                entidad que trata los datos obtenidos través de las cookies.</li>
        </ul>

        <p>En el caso de que las cookies sean instaladas desde un equipo o dominio gestionado
            por el propio editor pero la información que se recoja mediante éstas sea gestionada
            por un tercero, no pueden ser consideradas como cookies propias.</p>
        <p>Existe también una segunda clasificación según el plazo de tiempo que permanecen
            almacenadas en el navegador del cliente, pudiendo tratarse de:</p>
        <ul>
            <li>Cookies de sesión: diseñadas para recabar y almacenar datos mientras el
                usuario accede a una página web. Se suelen emplear para almacenar
                información que solo interesa conservar para la prestación del servicio
                solicitado por el usuario en una sola ocasión (p.e. una lista de productos
                adquiridos)</li>
            <li>Cookies persistentes: los datos siguen almacenados en el terminal y pueden ser
                accedidos y tratados durante un periodo definido por el responsable de la
                cookie, y que puede ir de unos minutos a varios años.</li>
        </ul>
        <p>Por último, existe otra clasificación según la finalidad para la que se traten los datos
            obtenidos:</p>
        <ul>
            <li>Cookies técnicas: aquellas que permiten al usuario la navegación a través de
                una página web, plataforma o aplicación y la utilización de las diferentes
                opciones o servicios que en ella existan como, por ejemplo, controlar el tráfico y
                la comunicación de datos, identificar la sesión, acceder a partes de acceso
                restringido, recordar los elementos que integran un pedido, realizar el proceso
                de compra de un pedido, realizar la solicitud de inscripción o participación en
                un evento, utilizar elementos de seguridad durante la navegación, almacenar
                contenidos para la difusión de vídeos o sonido o compartir contenidos a través
                de redes sociales.</li>
            <li>Cookies de personalización: permiten al usuario acceder al servicio con algunas
                características de carácter general predefinidas en función de una serie de
                criterios en el terminal del usuario como por ejemplo serian el idioma, el tipo de
                navegador a través del cual accede al servicio, la configuración regional desde
                donde accede al servicio, etc.</li>
            <li>Cookies de análisis: permiten al responsable de las mismas, el seguimiento y
                análisis del comportamiento de los usuarios de los sitios web a los que están
                vinculadas. La información recogida mediante este tipo de cookies se utiliza en
                la medición de la actividad de los sitios web, aplicación o plataforma y para la
                elaboración de perfiles de navegación de los usuarios de dichos sitios,
                aplicaciones y plataformas, con el fin de introducir mejoras en función del
                análisis de los datos de uso que hacen los usuarios del servicio.</li>
            <li>Cookies publicitarias: permiten la gestión, de la forma más eficaz posible, de los
                espacios publicitarios.</li>
            <li>Cookies de publicidad comportamental: almacenan información del
                comportamiento de los usuarios obtenida a través de la observación
                continuada de sus hábitos de navegación, lo que permite desarrollar un perfil
                específico para mostrar publicidad en función del mismo.</li>
            <li>Cookies de redes sociales externas: se utilizan para que los visitantes puedan
                interactuar con el contenido de diferentes plataformas sociales (facebook,
                youtube, twitter, linkedIn, etc.) y que se generen únicamente para los usuarios
                de dichas redes sociales. Las condiciones de utilización de estas cookies y la
                información recopilada se regula por la política de privacidad de la plataforma
                social correspondiente.</li>
        </ul>
        <h5>Desactivación y eliminación de cookies</h5>
        <p>Tienes la opción de permitir, bloquear o eliminar las cookies instaladas en tu equipo
            mediante la configuración de las opciones del navegador instalado en su equipo. Al
            desactivar cookies, algunos de los servicios disponibles podrían dejar de estar
            operativos. La forma de deshabilitar las cookies es diferente para cada navegador, pero
            normalmente puede hacerse desde el menú Herramientas u Opciones. También puede
            consultarse el menú de Ayuda del navegador dónde puedes encontrar instrucciones. El
            usuario podrá en cualquier momento elegir qué cookies quiere que funcionen en este
            sitio web.</p>
        <p>Puede usted permitir, bloquear o eliminar las cookies instaladas en su equipo mediante
            la configuración de las opciones del navegador instalado en su ordenador:</p>
        <ul>
            <li>Microsoft Edge:
                <a
                    href="https://support.microsoft.com/es-es/microsoft-edge/eliminar-las-cookies-en-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09">https://support.microsoft.com/es-es/microsoft-edge/eliminar-las-cookies-en-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09</a>
            </li>
            <li>Mozilla Firefox: <a
                    href="https://support.mozilla.org/es/kb/Borrar%20cookies">https://support.mozilla.org/es/kb/Borrar%20cookies</a>
            </li>
            <li>Chrome: <a
                    href="https://support.google.com/chrome/answer/95647?hl=es&co=GENIE.Platform%3DDesktop">https://support.google.com/chrome/answer/95647?hl=es&co=GENIE.Platform%3DDesktop</a>
            </li>
            <li>Safari: <a
                    href="https://support.apple.com/es-es/guide/safari/sfri11471/mac">https://support.apple.com/es-es/guide/safari/sfri11471/mac</a>
            </li>
            <li>Opera: <a
                    href="https://help.opera.com/en/latest/web-preferences/#cookies">https://help.opera.com/en/latest/web-preferences/#cookies</a>
            </li>
        </ul>
        <h5>Aceptación de la Política de cookies</h5>
        <p>
            <?= SITE_URL ?> asume que usted acepta el uso de cookies. No obstante, muestra
            información sobre su Política de cookies en la parte inferior o superior de cualquier
            página del portal con cada inicio de sesión con el objeto de que usted sea consciente.
        <p>
        <p>Ante esta información es posible llevar a cabo las siguientes acciones:</p>
        <ul>
            <li>Aceptar cookies: No se volverá a visualizar este aviso al acceder a cualquier
                página del portal durante la presente sesión.</li>
            <li>Rechazar cookies: No se volverá a visualizar este aviso al acceder a cualquier
                página del portal durante la presente sesión.</li>
        </ul>
    </section>

    <?php include("../modules/footer/footer.lite.php"); ?>

</body>

</html>

<style>
    #cookies-policy-section {
        margin: 100px 20px;
    }
</style>
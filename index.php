<!DOCTYPE html>
<html lang="es-CO">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="keywords" content="Ingeniería, Andrec" />
    <meta name="description" content="Administración de servicio Andrec" />
    <meta name="author" content="Harold Vallejo" />
    <link rel="apple-touch-icon" sizes="57x57" href="images/favicon/apple-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="60x60" href="images/favicon/appleimages/faviconimages/favicon-icon-60x60.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="images/favicon/apple-icon-72x72.pimages/faviconng" />
    <link rel="apple-touch-icon" sizes="76x76" href="images/favicon/apple-icon-7images/favicon6x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="images/favicon/apple-icon-11images/favicon4x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="images/favicon/apple-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="images/favicon/apple-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="images/favicon/apple-icon-152x152.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-icon-180x180.png" />
    <link rel="icon" type="image/png" sizes="192x192"  href="images/favicon/android-icon-192x192.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="96x96" href="images/favicon/favicon-96x96.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png" />
    <link rel="manifest" href="/manifest.json" />
    <meta name="msapplication-TileColor" content="#ffffff" />
    <meta name="msapplication-TileImage" content="images/favicon/ms-icon-144x144.png" />
    <meta name="theme-color" content="#ffffff" />
    <link rel="stylesheet" type="text/css" href="css/login_style.css" />
    <link rel="stylesheet" type="text/css" href="css/login_layout.css" />
    <title>Inicio Sesi&oacute;n</title>
</head>


<!-- Log in form-->
<body>
    <div id="log-in">
        <div id="logo">
            <a href="http://andreccorporation.com" target="_blank">
                <img src="images/logo.png" alt="logo" height="91" width="247" />
            </a>
        </div>
        <form method="post" action="user.php">
            <ul>
                <li>
                    <input type="text" name="user" id="user" placeholder="Usuario" class="form_input" />
                </li>
                <li>
                    <input type="password" name="pass" id="pass" placeholder="Contrase&ntilde;a" class="form_input" />
                </li>
                <li>
                    <input type="submit" value="Iniciar Sesi&oacute;n" />
                </li>
            </ul>
        </form>
    </div>
</body>

</html>
